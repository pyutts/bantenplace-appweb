<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserManagement extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'username'    => ['type' => 'VARCHAR', 'constraint' => '50'],
            'nama'        => ['type' => 'VARCHAR', 'constraint' => '100'],
            'email'       => ['type' => 'VARCHAR', 'constraint' => '70', 'unique' => true],
            'password'    => ['type' => 'VARCHAR', 'constraint' => '255'],
            'level'       => ['type' => 'ENUM', 'constraint' => ['Admin', 'User'], 'default' => 'User'],
            'no_telepon'  => ['type' => 'VARCHAR', 'constraint' => '15'],
            'kode_pos'    => ['type' => 'VARCHAR', 'constraint' => '6'],
            'alamat'      => ['type' => 'TEXT'],
            'profil_gambar' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('users');
    }


    public function down()
    {
        $this->forge->dropTable('users');
    }
}
