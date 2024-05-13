<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SpentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => 2,
                'value' => 50.00,
                'descricao' => 'Almoço',
                'created_at' => '2024-05-13 12:00:00'
            ],
            [
                'user_id' => 2,
                'value' => 30.00,
                'descricao' => 'Transporte',
                'created_at' => '2024-05-14 15:30:00'
            ],
            [
                'user_id' => 2,
                'value' => 25.00,
                'descricao' => 'Lanche',
                'created_at' => '2024-05-15 10:45:00'
            ],
            [
                'user_id' => 2,
                'value' => 40.00,
                'descricao' => 'Cinema',
                'created_at' => '2024-05-16 18:20:00'
            ],
            [
                'user_id' => 2,
                'value' => 20.00,
                'descricao' => 'Compras',
                'created_at' => '2024-05-17 14:00:00'
            ],
            [
                'user_id' => 2,
                'value' => 35.00,
                'descricao' => 'Jantar',
                'created_at' => '2024-05-18 20:45:00'
            ],
            [
                'user_id' => 2,
                'value' => 50.00,
                'descricao' => 'Café da manhã',
                'created_at' => '2024-05-19 08:30:00'
            ],
            [
                'user_id' => 2,
                'value' => 60.00,
                'descricao' => 'Presente',
                'created_at' => '2024-05-20 16:15:00'
            ],
        ];

        // Insert data
        $this->db->table('spent')->insertBatch($data);
    }
}
