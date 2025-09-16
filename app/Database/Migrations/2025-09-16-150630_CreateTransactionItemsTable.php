<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransactionItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'transaction_id' => ['type' => 'INT', 'unsigned' => true],
            'product_id'     => ['type' => 'INT', 'unsigned' => true],
            'qty'            => ['type' => 'INT', 'unsigned' => true],
            'price'          => ['type' => 'DECIMAL', 'constraint' => '12,2'],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('transaction_id', 'transactions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'RESTRICT', 'CASCADE');
        $this->forge->createTable('transaction_items');
    }

    public function down()
    {
        $this->forge->dropTable('transaction_items');
    }
}
