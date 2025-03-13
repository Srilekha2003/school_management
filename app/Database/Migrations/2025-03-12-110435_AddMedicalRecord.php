<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMedicalRecord extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'medical_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'student_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true
            ],
            'medical_issues' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'guardian_notified' => [
                'type'       => 'ENUM',
                'constraint' => ['Yes', 'No'],
                'default'    => 'No'
            ],
            'first_aid_given' => [
                'type'       => 'BOOLEAN',
                'default'    => false
            ],
            'remarks' => [
                'type' => 'TEXT',
                'null' => true
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

        $this->forge->addPrimaryKey('medical_id');
        $this->forge->addForeignKey('student_id', 'students', 'student_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('medicalrecords');
    }

    public function down()
    {
        $this->forge->dropTable('medicalrecords');
    }  
}
