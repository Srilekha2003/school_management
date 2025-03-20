<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTransport extends Migration
{
    public function up()
    {
        // Transport Table
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'student_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
            ],
            'route_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
            ],
            'bus_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
            ],
            'driver_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
            ],
            'pickup_location' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'drop_location' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                'default' => null,
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                'default' => null,
            ],
        ]);

        // Primary Key
        $this->forge->addPrimaryKey('id');

        // Foreign Keys
        // $this->forge->addForeignKey('student_id', 'students', 'student_id', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('route_id', 'transport_routes', 'route_id', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('bus_id', 'buses', 'bus_id', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('driver_id', 'drivers', 'driver_id', 'CASCADE', 'CASCADE');

        // Create Table
        $this->forge->createTable('transports');
    }

    public function down()
    {
        $this->forge->dropTable('transports');
    }
}
