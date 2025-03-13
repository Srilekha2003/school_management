<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBuses extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'bus_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'bus_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
                'unique'     => true,
            ],
            'capacity' => [
                'type'       => 'INT',
                'constraint' => 5,
                'null'       => false,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                'default' => null,
            ],
        ]);

        $this->forge->addPrimaryKey('bus_id');
        $this->forge->createTable('buses');
    }

    public function down()
    {
        $this->forge->dropTable('buses');
    }
}
