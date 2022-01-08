<?php

namespace App\Validation;

use App\models\KaryawanModel;

class CutiRules
{
    public function greater_than_equal_date(string $str, string $fields, array $data)
    {
        return $str >= $data[$fields];
    }

    public function sisa_cuti(string $str, string $fields, array $data, string &$error = null)
    {
        $karyawanModel = new KaryawanModel();
        $karyawan = $karyawanModel->where('nip', session()->get('nip'))->first();

        $diff = date_diff(date_create($data['tgl_mulai']), date_create($data['tgl_selesai']));
        if (($diff->days + 1) > $karyawan->jumlah_cuti) {
            $error = 'Sisa cuti karyawan tidak cukup';
            return false;
        };

        return true;
    }
}
