<?php
  
namespace App\Database\Migrations;
  
use CodeIgniter\Database\Migration;
  
class AddOwner extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
'type' => 'BIGINT',
'constraint' => 255,
'unsigned' => true,
'auto_increment' => true
            ],
            'email' => [
'type' => 'VARCHAR',
'unique' => true,
'constraint' => '255',
            ],
            'password' => [
'type' => 'VARCHAR',
'constraint' => '255',
            ],
            'created_at' => [
'type' => 'TIMESTAMP',
'null' => true
            ],
            'updated_at' => [
'type' => 'TIMESTAMP',
'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('owners');
    }
  
    public function down()
    {
        $this->forge->dropTable('owners');
    }
}