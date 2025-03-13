<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLibrary extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'isbn' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'unique'     => true
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255
            ],
            'author' => [
                'type'       => 'VARCHAR',
                'constraint' => 255
            ],
            'total_copies' => [
                'type'       => 'INT',
                'constraint' => 10,
                'default'    => 1
            ],
            'available_copies' => [
                'type'       => 'INT',
                'constraint' => 10,
                'default'    => 1
            ],
            'availability_status' => [
                'type'       => 'ENUM',
                'constraint' => ['Available', 'Issued', 'Reserved'],
                'default'    => 'Available'
            ],
            'issued_to' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => true
            ],
            'borrower_type' => [
                'type'       => 'ENUM',
                'constraint' => ['Student', 'Teacher', 'Staff'],
                'null'       => true
            ],
            'issue_date' => [
                'type' => 'DATE',
                'null' => true
            ],
            'due_date' => [
                'type' => 'DATE',
                'null' => true
            ],
            'return_date' => [
                'type' => 'DATE',
                'null' => true
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
        ]);

        $this->forge->addPrimaryKey('isbn');
        $this->forge->addForeignKey('issued_to', 'students', 'student_id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('libraries');
    }

    public function down()
    {
        $this->forge->dropTable('libraries');
    }
}
