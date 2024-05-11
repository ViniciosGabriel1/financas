<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSalariesTable extends Migration
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
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2', // Exemplo de tamanho e precisão
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

        $this->forge->createTable('salaries');
    }

    public function down()
    {
        $this->forge->dropTable('salaries');
    }
}
