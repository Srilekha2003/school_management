<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTransportRoutes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'route_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'route_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
                'unique'     => true,
            ],
            'starting_point' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'destination' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                'default' => null,
            ],
        ]);

        $this->forge->addPrimaryKey('route_id');
        $this->forge->createTable('transportroutes');
    }

    public function down()
    {
        $this->forge->dropTable('transportroutes');
    }
}
