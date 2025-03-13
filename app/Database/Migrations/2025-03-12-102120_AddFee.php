<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFee extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'fee_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'student_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
            ],
            'fee_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'amount_due' => [
                'type'       => 'DOUBLE',
                'null'       => false,
            ],
            'amount_paid' => [
                'type'       => 'DOUBLE',
                'default'    => 0.00,
            ],
            'discount' => [
                'type'       => 'DOUBLE',
                'default'    => 0.00,
            ],
            'due_date' => [
                'type' => 'DATE',
            ],
            'late_fee' => [
                'type'       => 'DOUBLE',
                'default'    => 0.00,
            ],
            'payment_status' => [
                'type'       => 'ENUM',
                'constraint' => ['Pending', 'Paid', 'Overdue'],
                'default'    => 'Pending',
            ],
            'payment_method' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'receipt_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('fee_id', true);
        $this->forge->addForeignKey('student_id', 'students', 'student_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('fees');
    }

    public function down()
    {
        $this->forge->dropTable('fees');
    }
}
