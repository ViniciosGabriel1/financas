<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSpentTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'valor' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'descricao' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'usuarios', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('spent');
    }

    public function down()
    {
        $this->forge->dropTable('spent');
    }
}
