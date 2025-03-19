<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStudent extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'student_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'date_of_birth' => [
                'type' => 'DATE',
            ],
            'gender' => [
                'type'       => 'ENUM',
                'constraint' => ['Male', 'Female', 'Other'],
                'default'    => 'Male',
            ],
            'aadhaar_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 12,
                'unique'     => true,
                'null'       => true
            ],
            'class_id' => [
                'type'       => 'BIGINT',
                'unsigned'   => true,
                'null'       => true,//false
            ],
            'roll_number' => [
                'type'       => 'INT',
                'constraint' => 10,
            ],
            'parent_id' => [
                'type'       => 'BIGINT',
                'unsigned'   => true,
                'null'       => true,//false
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'admission_date' => [
                'type' => 'DATE',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Active', 'Inactive'],
                'default'    => 'Active',
            ],
           'discontinuation_status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null'       => false,
                'default'    => 0, 
            ],

            'discontinuation_reason' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'discontinuation_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'rejoined' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0, // Default is false
            ],
            'rejoining_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'previous_class' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'new_class' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'blood_group' => [
                'type'       => 'VARCHAR',
                'constraint' => 5,
                'null'       => true,
            ],
            'emergency_contact' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => false,
            ],
            'student_photo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'extra_curricular_participation' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                'default' => null
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                'default' => null
            ],
            'deleted_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                'default' => null
            ],
        ]);

        // Primary Key
        $this->forge->addPrimaryKey('student_id');

        // Foreign Keys
        // $this->forge->addForeignKey('class_id', 'classes', 'class_id', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('parent_id', 'parents', 'parent_id', 'CASCADE', 'CASCADE');

        // Create Table
        $this->forge->createTable('students');
    }

    public function down()
    {
        $this->forge->dropTable('students', true);
    }

}
