<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddParent extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'parent_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'guardian_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'relationship' => [
                'type'       => 'ENUM',
                'constraint' => ['Father', 'Mother', 'Guardian'],
                'default'    => 'Guardian',
                'null'       => false,
            ],
            'occupation' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => true,
                'null'       => false,
            ],
            'contact_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => false,
            ],
            'address' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'student_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
            ],
        ]);

        // Primary Key
        $this->forge->addPrimaryKey('parent_id');

        // Foreign Key Constraint
        $this->forge->addForeignKey('student_id', 'students', 'student_id', 'CASCADE', 'CASCADE');

        // Create Table
        $this->forge->createTable('parents');
    }

    public function down()
    {
        $this->forge->dropTable('parents');
    }
}
