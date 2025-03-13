<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddClasses extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'class_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'class_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'class_teacher_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
            ],
            'total_students' => [
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => false,
            ],
            'section' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => false,
            ],
            'subjects_covered' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'timetable_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
            ],
        ]);

        $this->forge->addKey('class_id', true);
        $this->forge->addForeignKey('class_teacher_id', 'teachers', 'teacher_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('timetable_id', 'timetable', 'timetable_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('classes');
    }

    public function down()
    {
        $this->forge->dropTable('classes');
    }
}
