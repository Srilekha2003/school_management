<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCultural extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'event_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'event_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'date_time' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'venue' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'event_coordinator_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
            ],
            'awards_recognitions' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'remarks' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'participants' => [
                'type' => 'TEXT',
                'null' => true,
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
            'deleted_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                'default' => null,
            ],
        ]);

        $this->forge->addPrimaryKey('event_id');
        $this->forge->addForeignKey('event_coordinator_id', 'teachers', 'teacher_id', 'CASCADE', 'CASCADE');

      
        $this->forge->createTable('culturals'); 
    }

    public function down()
    {
       
        $this->forge->dropTable('culturals', true);
    }
}
