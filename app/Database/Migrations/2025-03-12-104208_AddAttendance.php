<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAttendance extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'attendance_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'student_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
            ],
            'teacher_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => true, // Nullable, as a teacher might not always be assigned
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Present', 'Absent', 'Late', 'Leave'],
                'null'       => false,
            ],
            'remarks' => [
                'type'       => 'TEXT',
                'null'       => true, // Optional comments
            ],
            'percentage_report' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2', // Example: 99.99%
                'null'       => true, // Optional, can be calculated dynamically
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

        $this->forge->addPrimaryKey('attendance_id');
        // $this->forge->addForeignKey('student_id', 'students', 'student_id', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('teacher_id', 'teachers', 'teacher_id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('attendances');
    }

    public function down()
    {
        $this->forge->dropTable('attendances');
    }
}
