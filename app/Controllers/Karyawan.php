<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\UserModel;

class Karyawan extends BaseController
{
    public function __construct()
    {
        if (session()->get('jabatan') !== 'Direktur') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); 
        }

        helper(['form']);


        $this->karyawanModel = new KaryawanModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        return view('karyawan/index', [
            'list_karyawan' => $this->karyawanModel->findAll(),
        ]);
    }

    public function add()
    {
        $request = $this->request;

        if ($request->getMethod() === 'post') {
            $rules = [
				'nip' => 'required|min_length[5]|max_length[10]|is_unique[karyawan.nip]',
				'nama' => 'required|min_length[2]|max_length[100]',
				'jabatan' => 'required|min_length[2]|max_length[100]',
				'password' => 'required|min_length[5]|max_length[100]',
				'jumlah_cuti' => 'required|numeric|max_length[3]',
			];

            if ($this->validate($rules)) {
                $this->userModel->insert([
                    'username' => $request->getPost('nip'),
                    'password' => $request->getPost('password'),
                ]);

                $this->karyawanModel->insert([
                    'nip' => $request->getPost('nip'),
                    'nama' => $request->getPost('nama'),
                    'jabatan' => $request->getPost('jabatan'),
                    'jumlah_cuti' => $request->getPost('jumlah_cuti'),
                    'username' => $request->getPost('nip'),
                ]);

                return redirect()->to('karyawan');
            }
        }

        return view('karyawan/form', [
            'mode' => 'Tambah',
            'list_jabatan' => KaryawanModel::LIST_JABATAN,
        ]);
    }

    public function edit($nip = null)
    {
        if (!$nip) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $karyawan = $this->karyawanModel->find($nip);
        if (!$karyawan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $request = $this->request;

        if ($request->getMethod() === 'post') {
            $rules = [
				'nama' => 'required|min_length[2]|max_length[100]',
				'jabatan' => 'required|min_length[2]|max_length[100]',
				'jumlah_cuti' => 'required|numeric|max_length[3]',
			];

            if ($this->validate($rules)) {
                $this->karyawanModel->update($nip, [
                    'nama' => $request->getPost('nama'),
                    'jabatan' => $request->getPost('jabatan'),
                    'jumlah_cuti' => $request->getPost('jumlah_cuti'),
                ]);

                if (!empty($request->getPost('password'))) {
                    $this->userModel->update($nip, [
                        'password' => $request->getPost('password'),
                    ]);
                }

                return redirect()->to('karyawan');
            }
        }

        return view('karyawan/form', [
            'mode' => 'Edit',
            'karyawan' => $karyawan,
            'list_jabatan' => KaryawanModel::LIST_JABATAN,
        ]);
    }

    public function delete($nip = null)
    {
        if ($this->request->getMethod() !== 'post') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (!$nip) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $karyawan = $this->karyawanModel->find($nip);
        if (!$karyawan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->karyawanModel->delete($nip);
        $this->userModel->delete($nip);

        return redirect()->to('karyawan');
    }
}
