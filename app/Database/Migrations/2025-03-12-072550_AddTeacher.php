<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTeacher extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'teacher_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'date_of_birth' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'gender' => [
                'type'       => 'ENUM',
                'constraint' => ['Male', 'Female', 'Other'],
                'null'       => false,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
              
            ],
            'phone_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => false,
                'unique'     => true,
            ],
            'address' => [
                'type'       => 'VARCHAR',
                'constraint' => 255, 
                'null'       => true, 
            ],
            'joining_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'employment_status' => [
                'type'       => 'ENUM',
                'constraint' => ['Full-time', 'Part-time', 'Contract'],
                'default'    => 'Full-time',
                'null'       => false,
            ],
            'retired' => [
                'type'       => 'ENUM',
                'constraint' => ['Yes', 'No'],
                'default'    => 'No',
                'null'       => false,
            ],
            'resigned' => [
                'type'       => 'ENUM',
                'constraint' => ['Yes', 'No'],
                'default'    => 'No',
                'null'       => false,
            ],
            'reason_for_leaving' => [
                'type'       => 'VARCHAR',
                'constraint' => 255, 
                'null'       => true, 
            ],
            'rejoined' => [
                'type'       => 'ENUM',
                'constraint' => ['Yes', 'No'],
                'default'    => 'No',
                'null'       => false,
            ],
            'rejoining_date' => [
                'type' => 'DATE',
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

        $this->forge->addPrimaryKey('teacher_id');
        $this->forge->createTable('teachers');
    }

    public function down()
    {
        $this->forge->dropTable('teachers');
    }
}
