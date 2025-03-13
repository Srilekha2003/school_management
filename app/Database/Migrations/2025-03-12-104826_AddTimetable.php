<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTimetable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'timetable_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'class_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
            ],
            'day_of_week' => [
                'type'       => 'ENUM',
                'constraint' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                'null'       => false,
            ],
            'period_number' => [
                'type'       => 'INT',
                'constraint' => 2,
                'null'       => false,
            ],
            'subject_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
            ],
            'teacher_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
            ],
            'start_time' => [
                'type' => 'TIME',
                'null' => false,
            ],
            'end_time' => [
                'type' => 'TIME',
                'null' => false,
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

        $this->forge->addPrimaryKey('timetable_id');
        // $this->forge->addForeignKey('class_id', 'classes', 'class_id', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('subject_id', 'subjects', 'subject_id', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('teacher_id', 'teachers', 'teacher_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('timetables');
    }

    public function down()
    {
        $this->forge->dropTable('timetables');
    }
}
