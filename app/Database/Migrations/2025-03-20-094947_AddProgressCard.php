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
                'unsigned'   => true,
                'null'       => false,
            ],
            'exam_id' => [
                'type'       => 'BIGINT',
                'unsigned'   => true,
                'null'       => false,
            ],
            'total_marks' => [
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => false,
            ],
            'obtained_marks' => [
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => false,
            ],
            'percentage' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null'       => false,
            ],
            'rank' => [
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => true,
            ],
            'grade' => [
                'type'       => 'VARCHAR',
                'constraint' => 5,
                'null'       => false,
            ],
            'result_status' => [
                'type'       => 'ENUM',
                'constraint' => ['Pass', 'Fail'],
                'null'       => false,
            ],
            'overall_remarks' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'teacher_signature' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'principal_signature' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
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
        $this->forge->addPrimaryKey('progress_card_id');

        // Foreign Keys
        $this->forge->addForeignKey('student_id', 'students', 'student_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('exam_id', 'exams', 'exam_id', 'CASCADE', 'CASCADE');

        // Create Table
        $this->forge->createTable('progresscards');
    }

    public function down()
    {
        $this->forge->dropTable('progresscards', true);
    }
}
