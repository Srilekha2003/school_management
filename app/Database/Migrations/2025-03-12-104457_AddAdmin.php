<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAdmin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'admin_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => false,
                'unique'     => true
            ],
            'phone_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => false
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['Super Admin', 'Admin', 'Moderator'],
                'default'    => 'Admin'
            ],
            'permissions' => [
                'type'       => 'TEXT',
                'null'       => true
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => null
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => null
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => null
            ],
        ]);

        $this->forge->addPrimaryKey('admin_id');
        $this->forge->createTable('admins');
    }

    public function down()
    {
        $this->forge->dropTable('admins');
    }
}
