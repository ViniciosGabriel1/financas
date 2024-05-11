<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableBalance extends Migration
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
                    'unsigned' => true,
                ],
                'category' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ],
                'value' => [
                    'type' => 'DECIMAL',
                    'constraint' => '10,2',
                ],
                'date' => [
                    'type' => 'DATE',
                ],
                'description' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],
            ]);
            
            $this->forge->addKey('id', true);
            $this->forge->addForeignKey('user_id', 'usuarios', 'id', 'CASCADE', 'CASCADE');
            $this->forge->createTable('balance');
        }
    
        public function down()
        {
            $this->forge->dropTable('balance');
        }
    }
    

