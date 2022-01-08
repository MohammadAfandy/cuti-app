<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table = 'karyawan';
    protected $primaryKey = 'nip';

    protected $returnType = 'object';

    protected $allowedFields = ['nip', 'nama', 'jabatan', 'jumlah_cuti', 'username'];

    const LIST_JABATAN = [
        'Staff',
        'Supervisor',
        'Manager',
        'Direktur',
    ];
}
