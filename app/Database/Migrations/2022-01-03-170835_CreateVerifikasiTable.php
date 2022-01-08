<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVerifikasiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'cuti_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'nip_verifikator' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => false],
            'waktu_verifikasi' => ['type' => 'DATETIME', 'null' => false],
            'status' => ['type' => 'ENUM', 'constraint' => ['reject', 'approve'], 'default' => 'Approve'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('cuti_id', 'cuti', 'id');
        $this->forge->addForeignKey('nip_verifikator', 'karyawan', 'nip');
        $this->forge->createTable('verifikasi');
    }

    public function down()
    {
        $this->forge->dropTable('verifikasi');
    }
}
