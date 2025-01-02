<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrdersManagement extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'order_id'     => ['type' => 'VARCHAR', 'constraint' => '50', 'unique' => true], 
            'user_id'      => ['type' => 'INT', 'unsigned' => true],
            'product_id'   => ['type' => 'INT', 'unsigned' => true],
            'quantity'     => ['type' => 'INT', 'constraint' => 11],
            'total_price'  => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'status'        => ['type' => 'ENUM', 'constraint' => ['Pending', 'Dibayar', 'Dikirim', 'Selesai'], 'default' => 'Pending'],
            'payment_method' => ['type' => 'VARCHAR', 'constraint' => '50'],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}
