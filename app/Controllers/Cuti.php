<?php

namespace App\Controllers;

use App\Models\CutiModel;
use App\Models\KaryawanModel;
use App\Models\VerifikasiModel;

class Cuti extends BaseController
{

    public function __construct()
    {
        helper(['form']);

        $this->cutiModel = new CutiModel();
        $this->karyawanModel = new KaryawanModel();
        $this->verifikasiModel = new VerifikasiModel();
    }

    public function index()
    {
        $karyawan = $this->karyawanModel->find(session()->get('nip'));
        $list_cuti = $this->cutiModel
                        ->select('cuti.*, karyawan.nama, verifikasi.waktu_verifikasi, karyawan_verifikator.nama AS nama_verifikator')
                        ->join('karyawan', 'karyawan.nip = cuti.nip')
                        ->join('verifikasi', 'verifikasi.cuti_id = cuti.id', 'left')
                        ->join('karyawan AS karyawan_verifikator', 'karyawan_verifikator.nip = verifikasi.nip_verifikator', 'left');
        if ($karyawan->jabatan !== 'Staff') {
            $list_cuti = $list_cuti->findAll();
        } else {
            $list_cuti = $list_cuti->where('cuti.nip', $karyawan->nip)->findAll();
        }
        // dd($list_cuti);

        return view('cuti/index', [
            'karyawan' => $karyawan,
            'list_cuti' => $list_cuti,
        ]);
    }

    public function form()
    {
        $request = $this->request;
        $karyawan = $this->karyawanModel->find(session()->get('nip'));

        if ($request->getMethod() === 'post') {

            $rules = [
				'tgl_mulai' => 'required|valid_date[Y-m-d]',
				'tgl_selesai' => 'required|valid_date[Y-m-d]|greater_than_equal_date[tgl_mulai]|sisa_cuti[]',
			];

            $errors = [
                'tgl_selesai' => [
                    'greater_than_equal_date' => 'Tanggal Selesai harus lebih besar atau sama dengan tanggal mulai',
                ],
            ];

            if ($this->validate($rules, $errors)) {
                $tgl_mulai = $request->getPost('tgl_mulai');
                $tgl_selesai = $request->getPost('tgl_selesai');

                $this->cutiModel->insert([
                    'nip' => $karyawan->nip,
                    'tgl_mulai' => $tgl_mulai,
                    'tgl_selesai' => $tgl_selesai,
                    'keterangan' => $request->getPost('keterangan'),
                ]);

                // kurangi sisa cuti karyawan
                $diff = date_diff(date_create($tgl_mulai), date_create($tgl_selesai))->days + 1;
                $this->karyawanModel->update($karyawan->nip, [
                    'jumlah_cuti' => $karyawan->jumlah_cuti - $diff,
                ]);

                return redirect()->to('cuti');
            }

        }

        return view('cuti/form', [
            'karyawan' => $karyawan,
        ]);
    }

    public function verify($id, $verify_type) {
        if ($this->request->getMethod() !== 'post') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (!$id || !$verify_type) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $cuti = $this->cutiModel->find($id);
        if (!$cuti) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->cutiModel->update($id, [
            'status' => $verify_type,
        ]);
        $this->verifikasiModel->insert([
            'cuti_id' => $id,
            'waktu_verifikasi' => date('Y-m-d H:i:s'),
            'nip_verifikator' => session()->get('nip'),
            'status' => $verify_type,  
        ]);

        // jika direject, kemabalikan sisa cuti karyawan
        if ($verify_type === 'reject') {
            $diff = date_diff(date_create($cuti->tgl_mulai), date_create($cuti->tgl_selesai))->days + 1;

            $karyawan = $this->karyawanModel->find($cuti->nip);
            $this->karyawanModel->update($cuti->nip, [
                'jumlah_cuti' => $karyawan->jumlah_cuti + $diff,
            ]);
        }

        return redirect()->to('cuti');
    }
}
