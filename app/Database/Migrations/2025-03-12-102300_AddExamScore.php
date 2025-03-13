<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddExamScore extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'score_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'exam_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
            ],
            'student_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
            ],
            'marks_obtained' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null'       => false,
            ],
            'total_marks' => [
                'type'       => 'INT',
                'constraint' => 5,
                'null'       => false,
            ],
            'percentage' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null'       => true,
            ],
            'grade' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => false,
            ],
            'result_status' => [
                'type'       => 'ENUM',
                'constraint' => ['Pass', 'Fail'],
                'null'       => false,
            ],
            'remarks' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type'       => 'TIMESTAMP',
                'null'       => true,
                'default'    => null,
            ],
            'updated_at' => [
                'type'       => 'TIMESTAMP',
                'null'       => true,
                'default'    => null,
            ],
        ]);

        $this->forge->addPrimaryKey('score_id');
        // $this->forge->addForeignKey('exam_id', 'exams', 'exam_id', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('student_id', 'students', 'student_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('examscores');
    }

    public function down()
    {
        $this->forge->dropTable('examscores');
    }
}
