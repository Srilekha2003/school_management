<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddExam extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'exam_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'exam_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'exam_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'start_time' => [
                'type' => 'TIME',
                'null' => false,
            ],
            'end_time' => [
                'type' => 'TIME',
                'null' => false,
            ],
            'total_marks' => [
                'type'       => 'INT',
                'constraint' => 5,
                'null'       => false,
            ],
            'passing_marks' => [
                'type'       => 'INT',
                'constraint' => 5,
                'null'       => false,
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
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'deleted_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addPrimaryKey('exam_id');
        $this->forge->addForeignKey('subject_id', 'subjects', 'subject_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('class_id', 'classes', 'class_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('exams');
    }

    public function down()
    {
        $this->forge->dropTable('exams');
    }
}
