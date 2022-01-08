<?php

namespace App\Models;

use CodeIgniter\Model;

class VerifikasiModel extends Model
{
    protected $table = 'verifikasi';
    protected $primaryKey = 'id';

    protected $returnType = 'object';

    protected $allowedFields = ['cuti_id', 'waktu_verifikasi', 'nip_verifikator', 'status'];

}
