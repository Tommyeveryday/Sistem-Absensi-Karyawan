<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Employee extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 30,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'company_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'middle_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'default' => '',
                'null' => true,
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'department' => [
                'type' => 'TEXT',
            ],
            'position' => [
                'type' => 'TEXT',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('employees');
    }

    public function down()
    {
        $this->forge->dropTable('employees');
    }
}
