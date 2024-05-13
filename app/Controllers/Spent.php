<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SpentModel;
use CodeIgniter\HTTP\ResponseInterface;

class Spent extends BaseController
{
    public function spent_form()
    {

        return view('forms/spent_form');
    }


    public function spent_submit()
    {
        // Verificar se o usuário está autenticado
        if (!session()->has('user')) {
            // Usuário não autenticado, redirecionar para o login
            return redirect()->to('auth/login_form')->with('erro_auth', 'Usuário não autenticado.');
        }

        $user = session()->get('user');
        $userId = $user->id;

        $amount_spent = $this->request->getPost('amount_spent');
        $description = $this->request->getPost('description');

        if (empty($amount_spent) || empty($description)) {
            return redirect()->back()->with('error', 'Por favor, preencha todos os campos.');
        }

        $spentModel = new SpentModel();

        // Verificar se já existe um gasto registrado para o dia atual
        // Verificar se já existe um gasto registrado para o dia atual
        $today = date('Y-m-d');
        $existingSpent = $spentModel->where('user_id', $userId)
            ->where('DATE(created_at)', $today)
            ->first();

        if ($existingSpent) {
            // Se houver um gasto existente, some o novo valor ao valor existente
            $newAmount = $existingSpent->value + $amount_spent; // Use a seta (->) para acessar as propriedades do objeto

            // Atualize o registro existente com o novo valor
            $spentModel->update($existingSpent->id, ['value' => $newAmount]); // Use a seta (->) para acessar as propriedades do objeto
        } else {
            // Se não houver um gasto existente, insira um novo registro
            $data = [
                'user_id' => $userId,
                'value' => $amount_spent,
                'descricao' => $description,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $spentModel->insert($data);
        }

        // Redirecionar para a view 'index' no controlador 'Dash'
        return redirect()->to('/dash/index')->with('success', 'Salário inserido com sucesso.');
    }
}
