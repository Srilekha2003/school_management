<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProgressCard extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'progress_card_id' => [
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
            'exam_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true
            ],
            'total_marks' => [
                'type'       => 'INT',
                'constraint' => 10
            ],
            'obtained_marks' => [
                'type'       => 'INT',
                'constraint' => 10
            ],
            'percentage' => [
                'type'       => 'DOUBLE',
                'constraint' => '5,2'
            ],
            'rank' => [
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => true
            ],
            'grade' => [
                'type'       => 'VARCHAR',
                'constraint' => 5
            ],
            'result_status' => [
                'type'       => 'ENUM',
                'constraint' => ['Pass', 'Fail'],
                'default'    => 'Pass'
            ],
            'overall_remarks' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'teacher_signature' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true
            ],
            'principal_signature' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true
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
            ]
        ]);

        $this->forge->addPrimaryKey('progress_card_id');
        $this->forge->addForeignKey('student_id', 'students', 'student_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('exam_id', 'exams', 'exam_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('progress_cards');
    }


    public function down()
    {
        $this->forge->dropTable('progress_cards');
    }
}
