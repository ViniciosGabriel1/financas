<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BalanceModel;
use App\Models\SalaryModel;
use CodeIgniter\HTTP\ResponseInterface;

class Salary extends BaseController
{
    public function salary_form()

    {
        if (!session()->has('user')) {
            // Usuário não autenticado, redirecionar para a página de login
            return redirect()->to('auth/login_form');
        }
        return view('forms/salary_form');
    }

    public function salary_submit()
    {

        // Verificar se o usuário está autenticado
        if (!session()->has('user')) {
            // Usuário não autenticado, redirecionar para o login
            return redirect()->to('auth/login_form')->with('erro_auth', 'Usuário não autenticado.');
        }

        $user = session()->get('user');
        $userId = $user->id;

        $salario = $this->request->getPost('salary');
        // Recuperar o salário enviado pelo formulário
        if (empty($salario)) {
            return redirect()->back()->with('error', 'Por favor, preencha todos os campos.');
        }

        // Armazenar o salário na sessão
        session()->set('salario', $salario);

        // Criar um novo registro de salário na tabela salaries
        $salaryModel = new SalaryModel();
        $salaryModel->where('user_id', $userId)->set(['value' => $salario])->update();

        // Atualizar o registro de saldo na tabela balances
        $balanceModel = new BalanceModel();
        $balanceModel->where('user_id', $userId)->set(['value' => $salario])->update();


        // Redirecionar para a view 'index' no controlador 'Dash'
        return redirect()->to('/forms/spent_form')->with('success', 'Salário inserido com sucesso.');
    }
}
