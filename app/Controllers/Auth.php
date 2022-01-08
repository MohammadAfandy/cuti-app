<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\KaryawanModel;

class Auth extends BaseController
{

    public function __construct()
    {
        helper(['form']);

        $this->userModel = new UserModel();
        $this->karyawanModel = new KaryawanModel();
    }

    public function login()
    {
        $request = $this->request;

        if (session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        if ($request->getMethod() === 'post') {
            $rules = [
				'username' => 'required|min_length[5]|max_length[10]',
				'password' => 'required|min_length[5]|max_length[100]|validateLogin[]',
			];

            if ($this->validate($rules)) {
                $karyawan = $this->karyawanModel
                    ->where('username', $request->getPost('username'))
                    ->first();

                session()->set([
                    'username' => $karyawan->username,
                    'nama' => $karyawan->nama,
                    'nip' => $karyawan->nip,
                    'jabatan' => $karyawan->jabatan,
                    'isLoggedIn' => true,
                ]);

                return redirect()->to('/');
            }
        }

        return view('auth/login');
    }

    public function logout()
    {
		session()->destroy();
		return redirect()->to('/');
	}
}
