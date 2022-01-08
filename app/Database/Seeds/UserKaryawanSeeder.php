<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserKaryawanSeeder extends Seeder
{
    public function run()
    {
        // Direktur
        $this->db->table('user')->insert([
            'username' => '111111',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
        ]);

        $this->db->table('karyawan')->insert([
            'nip' => '111111',
            'nama' => 'Direktur 1',
            'jabatan' => 'Direktur',
            'jumlah_cuti' => 12,
            'username' => '111111',
        ]);

        // Manager
        $this->db->table('user')->insert([
            'username' => '222222',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
        ]);

        $this->db->table('karyawan')->insert([
            'nip' => '222222',
            'nama' => 'Manager 1',
            'jabatan' => 'Manager',
            'jumlah_cuti' => 12,
            'username' => '222222',
        ]);

        // Supervisor
        $this->db->table('user')->insert([
            'username' => '333333',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
        ]);

        $this->db->table('karyawan')->insert([
            'nip' => '333333',
            'nama' => 'Supervisor 1',
            'jabatan' => 'Supervisor',
            'jumlah_cuti' => 12,
            'username' => '333333',
        ]);

        // Staff
        $this->db->table('user')->insert([
            'username' => '444444',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
        ]);

        $this->db->table('karyawan')->insert([
            'nip' => '444444',
            'nama' => 'Staff 1',
            'jabatan' => 'Staff',
            'jumlah_cuti' => 12,
            'username' => '444444',
        ]);
    }
}
