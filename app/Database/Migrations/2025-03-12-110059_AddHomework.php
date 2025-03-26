<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddHomework extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'subject_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
            ],
            'class_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
            ],
            'assigned_by' => [
               'type'       => 'TEXT',
                'null'       => true, 
            ],
            'assigned_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'due_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'submission_status' => [
                'type'       => 'ENUM',
                'constraint' => ['Not Submitted', 'Submitted', 'Late'],
                'default'    => 'Not Submitted',
                'null'       => false,
            ],
            'evaluation_status' => [
                'type'       => 'ENUM',
                'constraint' => ['Pending', 'Evaluated'],
                'default'    => 'Pending',
                'null'       => false,
            ],
            'remarks' => [
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
        ]);

        $this->forge->addPrimaryKey('id');
        // $this->forge->addForeignKey('subject_id', 'subjects', 'subject_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('class_id', 'classes', 'class_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('assigned_by', 'teachers', 'teacher_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('homework');
    }

    public function down()
    {
        $this->forge->dropTable('homework');
    }
}
