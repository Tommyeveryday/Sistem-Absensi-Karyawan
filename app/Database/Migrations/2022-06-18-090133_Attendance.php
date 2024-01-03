<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Attendance extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 30,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'employee_id' => [
                'type'       => 'INT',
                'constraint' => 30,
                'unsigned'       => true,
            ],
            'created_at datetime default current_timestamp',
            'log_type' => [
                'type'       => 'TINYINT',
                'constraint' => '1',
                'default' => '1',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id',true);
        $this->forge->addForeignKey('employee_id', 'employees', 'id','NO ACTION','CASCADE');
        $this->forge->createTable('attendance');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('attendance');
    }
}
