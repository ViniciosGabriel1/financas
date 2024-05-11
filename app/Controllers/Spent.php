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

        if (empty($amount_spent) and (empty($description))) {
            return redirect()->back()->with('error', 'Por favor, preencha todos os campos.');
        }

        $spentModel = new SpentModel();
        
        $data = [
            'user_id' => $userId,
            'value' => $amount_spent,
            'descricao' => $description
            // Outros campos, se houver
        ];
        $spentModel->insert($data);
        
        // Redirecionar para a view 'index' no controlador 'Dash'
        return redirect()->to('/dash/index')->with('success', 'Salário inserido com sucesso.');
        


    }
}
