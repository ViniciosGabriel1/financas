<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DadosTabelaUsuarios extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'email'    => 'admin@example.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                // Adicione outros campos e valores conforme necessário
            ],
            [
                'username' => 'user',
                'email'    => 'user@example.com',
                'password' => password_hash('user123', PASSWORD_DEFAULT),
                // Adicione outros campos e valores conforme necessário
            ],
        ];

        // Insere os dados na tabela 'usuarios'
        $this->db->table('usuarios')->insertBatch($data);
    }
}
