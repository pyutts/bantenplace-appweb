<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reports extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'title'         => ['type' => 'VARCHAR', 'constraint' => '255'], 
            'description'   => ['type' => 'TEXT', 'null' => true], 
            'start_date'    => ['type' => 'DATE'], 
            'end_date'      => ['type' => 'DATE'], 
            'total_orders'  => ['type' => 'INT', 'unsigned' => true, 'null' => true], 
            'total_income'  => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => true], 
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('reports');
    }

    public function down()
    {
        $this->forge->dropTable('reports');
    }
}