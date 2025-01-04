<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'order_id'        => ['type' => 'INT', 'unsigned' => true],
            'payment_method'  => ['type' => 'VARCHAR', 'constraint' => '100'], 
            'payment_status'  => ['type' => 'ENUM', 'constraint' => ['Pending', 'Berhasil', 'Gagal'], 'default' => 'Pending'], 
            'amount_paid'     => ['type' => 'DECIMAL', 'constraint' => '15,2'], 
            'payment_date'    => ['type' => 'DATETIME', 'null' => true], 
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('order_id', 'orders', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payment_details');
    }

    public function down()
    {
        $this->forge->dropTable('payment_details');
    }
}