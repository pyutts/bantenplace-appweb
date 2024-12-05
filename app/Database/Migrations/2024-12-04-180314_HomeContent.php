<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HomeContent extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'title'       => ['type' => 'VARCHAR', 'constraint' => '150'],
            'content'     => ['type' => 'TEXT'],
            'image'       => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('landing_contents');
    }

    public function down()
    {
        $this->forge->dropTable('landing_contents');
    }
}
