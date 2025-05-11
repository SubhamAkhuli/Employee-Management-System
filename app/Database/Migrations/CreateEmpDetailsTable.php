<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmpDetailsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'name'        => [
                'type'       => 'VARCHAR',
                'constraint' => 255
            ],
            'address'     => [
                'type' => 'TEXT'
            ],
            'designation' => [
                'type'       => 'VARCHAR',
                'constraint' => 100
            ],
            'salary'      => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2'
            ],
            'picture'     => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true
            ],
            'created_at'  => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at'  => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('emp_details');
    }

    public function down()
    {
        $this->forge->dropTable('emp_details');
    }
}
