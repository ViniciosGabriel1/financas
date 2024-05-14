<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateExpenseBalanceTable extends Migration
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
            'balance' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0,
            ],
            'date' => [
                'type' => 'DATE',
            ],
        ]);
    
        $this->forge->addPrimaryKey('id');
    
        // Adiciona a chave estrangeira user_id referenciando a coluna id na tabela de usuários (users)
        $this->forge->addForeignKey('user_id', 'usuarios', 'id');
    
        $this->forge->createTable('expense_balance');
    }
    

    public function down()
    {
        $this->forge->dropTable('expense_balance');
    }
}
