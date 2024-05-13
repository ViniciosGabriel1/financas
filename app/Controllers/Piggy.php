<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PiggyModel;
use CodeIgniter\HTTP\ResponseInterface;

class Piggy extends BaseController
{
    public function piggy_form()
    {
        if (!session()->has('user')) {
            // Usuário não autenticado, redirecionar para a página de login
            return redirect()->to('auth/login_form');
        }
        return view('forms/piggy_form');
    }


    public function goal_submit()
    {
        // Verificar se $senha é uma string antes de prosseguir
        $validated = $this->validate([
            'goal' => 'required',
            'title_goal'=> 'required',
            'due_date' => 'required'

        ]);

        if (!$validated) {
            return redirect()->route('forms/piggy_form')->with('error_goal', ' Insira algum valor no campo antes de enviar!');
        }

        $user = session()->get('user');
        $userId = $user->id;

        $title_goal = $this->request->getPost('title_goal');
        $goal = $this->request->getPost('goal');
        $due_date = $this->request->getPost('due_date');

        $piggyModel = new PiggyModel();

        $data = [
            
            'user_id' => $userId,
            'goal' => $goal,
            'goal_title' => $title_goal,
            'due_date' => $due_date
        ];
        $piggyModel->insert($data);

        return redirect()->to('/forms/piggy_form')->with('success_goal', 'Meta criada com sucesso.');



    }



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
        
        $piggyModel = new PiggyModel();
        
        // Obtém o valor atual do campo 'value' para o usuário logado
        $currentValue = $piggyModel->where('user_id', $userId)->get()->getRow()->value;
        
        // Calcula o novo valor somando o valor atual com o valor submetido no formulário
        $newValue = $currentValue + $piggy;
        
        // Atualiza o valor na tabela 'piggy' para o usuário logado
        $piggyModel->where('user_id', $userId)->set('value', $newValue)->update();
        
        return redirect()->to('/forms/piggy_form')->with('success_piggy', 'Parabéns pela economia!');

    }
}
