<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTimestampsToOrders extends Migration
{
    public function up()
    {
        $this->forge->addColumn('orders', [
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
    }
    
    public function down()
    {
        $this->forge->dropColumn('orders', ['created_at', 'updated_at']);
    }
    
}
