<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSetting extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'school_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false
            ],
            'academic_year' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false
            ],
            'grading_system' => [
                'type'       => 'TEXT',
                'null'       => true
            ],
            'attendance_rules' => [
                'type'       => 'TEXT',
                'null'       => true
            ],
            'exam_policies' => [
                'type'       => 'TEXT',
                'null'       => true
            ],
            'notification_preferences' => [
                'type'       => 'TEXT',
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
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('settings');
    }

    public function down()
    {
        $this->forge->dropTable('settings');
    }
}
