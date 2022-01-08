<?php

namespace App\Models;

use CodeIgniter\Model;

class CutiModel extends Model
{
    protected $table = 'cuti';
    protected $primaryKey = 'id';

    protected $returnType = 'object';

    protected $allowedFields = ['nip', 'tgl_mulai', 'tgl_selesai', 'keterangan', 'status'];

    const LIST_STATUS = [
        'pending',
        'reject',
        'approve',
    ];
}
