<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PiggyModel;
use CodeIgniter\HTTP\ResponseInterface;

class Piggy extends BaseController

{
    private $piggyModel;

    public function __construct()
    {
        $this->piggyModel = new PiggyModel();
    }


    public function piggy_form()
    {
        // Verificar se o usuário está autenticado
        if (!session()->has('user')) {
            // Usuário não autenticado, redirecionar para o login
            return redirect()->to('auth/login_form')->with('erro_auth', 'Usuário não autenticado.');
        }

        // Obter o ID do usuário da sessão
        $userId = session()->get('user')->id;

        // Verificar se já existe um porquinho financeiro registrado para o usuário atual
        $existingPiggy = $this->piggyModel->where('user_id', $userId)->first();

        // Preparar os dados para o formulário
        $data = [
            'existingPiggy' => $existingPiggy // Passar o porquinho financeiro existente para a view
        ];

        // Carregar a view com os dados preparados
        return view('forms/piggy_form', $data);
    }


    public function goal_submit()
    {
        // Verificar se o usuário está autenticado
        if (!session()->has('user')) {
            // Usuário não autenticado, redirecionar para o login
            return redirect()->to('auth/login_form')->with('erro_auth', 'Usuário não autenticado.');
        }

        $user = session()->get('user');
        $userId = $user->id;

        // Obtenha os dados do formulário
        $titleGoal = $this->request->getPost('title_goal');
        $goal = $this->request->getPost('goal');
        $dueDate = $this->request->getPost('due_date');

        // Validação dos campos (adicione conforme necessário)

        // Execute a lógica para criar ou atualizar o objetivo financeiro
        $message = $this->piggyModel->insertOrUpdateGoal($userId, $titleGoal, $goal, $dueDate);
        // dd($message);
        // Determine a URL para redirecionamento com base no sucesso ou falha da operação

        // Determine a URL para redirecionamento com base no sucesso ou falha da operação
        if ($message === 'Porquinho financeiro atualizado com sucesso.' || $message === 'Objetivo financeiro criado com sucesso.') {
            $redirectUrl = '/forms/piggy_form'; // Redireciona de volta ao formulário
        } else {
            $redirectUrl = '/dash/index'; // Redireciona para outra página
        }

        // Redirecionar com a mensagem de sucesso ou erro
        return redirect()->to($redirectUrl)->with('message', $message);


        // Redirecionar com a mensagem de sucesso ou erro
    }


    // No seu Piggy Controller ou onde deseja processar a atualização
    // public function goal_update()
    // {
    //     // Verifique se o usuário está autenticado
    //     if (!session()->has('user')) {
    //         // Usuário não autenticado, redirecionar para o login
    //         return redirect()->to('auth/login_form')->with('erro_auth', 'Usuário não autenticado.');
    //     }

    //     $user = session()->get('user');
    //     $userId = $user->id;

    //     // Obtenha os dados do formulário
    //     $titleGoal = $this->request->getPost('title_goal');
    //     $goal = $this->request->getPost('goal');
    //     $dueDate = $this->request->getPost('due_date');

    //     // Validação dos campos (adicione conforme necessário)

    //     // Execute a lógica para atualizar o objetivo financeiro
    //     $this->piggyModel->updateGoal($userId, $titleGoal, $goal, $dueDate);

    //     // Redirecionar para a página de perfil do usuário ou onde deseja após a atualização
    //     return redirect()->to('/forms/piggy_form')->with('success_update', 'Porquinho atualizado com sucesso.');
    // }




    public function piggy_submit()
    {
        // Verificar se $senha é uma string antes de prosseguir
        $validated = $this->validate([
            'piggy' => 'required',

        ]);

        if (!$validated) {
            return redirect()->route('forms/piggy_form')->with('error_piggy',  'Insira algum valor no campo antes de enviar!');
        }

        $user = session()->get('user');
        $userId = $user->id;

        $piggy = $this->request->getPost('piggy');


        // Obtém o valor atual do campo 'value' para o usuário logado
        $currentValue = $this->piggyModel->where('user_id', $userId)->get()->getRow()->value;

        // Calcula o novo valor somando o valor atual com o valor submetido no formulário
        $newValue = $currentValue + $piggy;

        // Atualiza o valor na tabela 'piggy' para o usuário logado
        $this->piggyModel->where('user_id', $userId)->set('value', $newValue)->update();

        return redirect()->to('/forms/piggy_form')->with('success_piggy', 'Parabéns pela economia!');
    }
}
