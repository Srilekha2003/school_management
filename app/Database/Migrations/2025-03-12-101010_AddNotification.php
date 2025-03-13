<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNotification extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'notification_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false
            ],
            'message' => [
                'type' => 'TEXT',
                'null' => false
            ],
            'date_time' => [
                'type' => 'DATETIME',
                'null' => false
            ],
            'recipient_type' => [
                'type'       => 'ENUM',
                'constraint' => ['Students', 'Teachers', 'Parents', 'All'],
                'default'    => 'All',
                'null'       => false
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Read', 'Unread'],
                'default'    => 'Unread',
                'null'       => false
            ],
            'timetable_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => true
            ]
            
            
        ]);

        $this->forge->addPrimaryKey('notification_id');
        $this->forge->addForeignKey('timetable_id', 'timetable', 'timetable_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('notifications');
    }

    public function down()
    {
        $this->forge->dropTable('notifications');
    }
}
