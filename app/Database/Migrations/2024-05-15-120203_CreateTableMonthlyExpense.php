<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMonthlyExpensesTable extends Migration
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
            'year' => [
                'type' => 'INT',
                'constraint' => 4,
                'unsigned' => true,
            ],
            'month' => [
                'type' => 'INT',
                'constraint' => 2,
                'unsigned' => true,
            ],
            'total' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true, // Permitir NULL como valor padrão
                'default' => null, // Definir o valor padrão como NULL
            ],
            
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'usuarios', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('monthly_expenses');
    }

    public function down()
    {
        $this->forge->dropTable('monthly_expenses');
    }
}
