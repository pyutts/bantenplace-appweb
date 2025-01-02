<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductManagement extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'kodeproduk'   => ['type' => 'VARCHAR', 'constraint' => '50', 'unique' => true],
            'gambar_produk' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'name'         => ['type' => 'VARCHAR', 'constraint' => '150'],
            'description'  => ['type' => 'TEXT', 'null' => true],
            'price'        => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'stock'        => ['type' => 'INT', 'constraint' => 11],
            'category_id'  => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
