<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateRatingColumn extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('comments', [
            'rating' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => true, // Allow NULL values
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('comments', [
            'rating' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => false, // Revert back to NOT NULL
            ],
        ]);
    }
}
