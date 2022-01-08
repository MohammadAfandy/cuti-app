<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCutiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nip' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => false],
            'tgl_mulai' => ['type' => 'DATE', 'null' => false],
            'tgl_selesai' => ['type' => 'DATE', 'null' => false],
            'keterangan' => ['type' => 'TEXT', 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['pending', 'reject', 'approve'], 'default' => 'Pending'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('nip', 'karyawan', 'nip');
        $this->forge->createTable('cuti');
    }

    public function down()
    {
        $this->forge->dropTable('cuti');
    }
}