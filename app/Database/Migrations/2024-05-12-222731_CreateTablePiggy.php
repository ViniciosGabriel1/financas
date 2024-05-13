<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePiggy extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'goal_title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'goal' => [
                'type' => 'INT',
                'constraint' => 100,
            ],
            'due_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'value' => [
                'type' => 'INT',
                'constraint' => 100,
            ],
            // Adicione outras colunas conforme necessário
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        // Adicione chave estrangeira para user_id, se necessário
        $this->forge->addForeignKey('user_id', 'usuarios', 'id');
        $this->forge->createTable('piggy');
    }

    public function down()
    {
        $this->forge->dropTable('piggy');
    }
}
