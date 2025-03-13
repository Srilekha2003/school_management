<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddHostel extends Migration
{
    public function up()
    {
        
        $this->forge->addField([
            'hostel_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'hostel_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'warden_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'warden_contact' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => false,
                'unique'     => true,
            ],
            'total_rooms' => [
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

        $this->forge->addPrimaryKey('hostel_id');
        $this->forge->createTable('hostels');

    }
    public function down()
    {
     
        $this->forge->dropTable('hostels');
    }
}
