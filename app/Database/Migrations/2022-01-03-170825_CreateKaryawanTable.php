<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKaryawanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nip' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => false],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'jabatan' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'jumlah_cuti' => ['type' => 'INT', 'constraint' => 10, 'null' => false, 'unsigned' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
        ]);
        $this->forge->addKey('nip', true);
        $this->forge->addForeignKey('username', 'user', 'username');
        $this->forge->createTable('karyawan');
    }

    public function down()
    {
        $this->forge->dropTable('karyawan');
    }
}
