<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
{public function up()
    {
        // Check if the table exists before creating it
        if (!$this->db->tableExists('products')) {
            $this->forge->addField([
                'id' => [
                    'type' => 'INT',
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'name' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                ],
                'price' => [
                    'type' => 'DECIMAL',
                    'constraint' => '10,2',
                ],
                'description' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],
                'image' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => true,
                ],
                'created_at' => [
    'type' => 'DATETIME',
    'null' => true,
],

            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('products');
        }
    }
    

    public function down()
    {
        $this->forge->dropTable('products', true);
    }
}
