<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ExpenseBalanceModel;
use App\Models\SpentModel;
use CodeIgniter\HTTP\ResponseInterface;

class Spent extends BaseController

{
    private $spentModel;
    private $expenseBalanceModel;


    public function __construct()
    {
        $this->spentModel = new SpentModel();

        $this->expenseBalanceModel = new ExpenseBalanceModel();
    }
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
    
        $amountSpent = $this->request->getPost('amount_spent');
        $description = $this->request->getPost('description');
    
        if (empty($amountSpent) || empty($description)) {
            return redirect()->back()->with('error', 'Por favor, preencha todos os campos.');
        }
    
        // Verificar se já existe um gasto registrado para o dia atual
        $today = date('Y-m-d');
        $existingSpent = $this->expenseBalanceModel->where('user_id', $userId)
            ->where('DATE(date)', $today)
            ->first();
    
        if ($existingSpent) {
            // Se houver um gasto existente, some o novo valor ao valor existente
            $newAmount = $existingSpent->balance + $amountSpent; // Use a seta (->) para acessar as propriedades do objeto
    
            // Atualize o registro existente com o novo valor
            $this->expenseBalanceModel->update($existingSpent->id, ['balance' => $newAmount]); // Use a seta (->) para acessar as propriedades do objeto
        } else {
            // Se não houver um gasto existente, insira um novo registro
            $data = [
                'user_id' => $userId,
                'balance' => $amountSpent,
                'date' => date('Y-m-d H:i:s')
            ];
    
            $this->expenseBalanceModel->insert($data);
        }
    
            // Se não houver um registro para o saldo do usuário no dia atual, insira um novo registro
            $data = [
                'user_id' => $userId,
                'value' => $amountSpent,
                'descricao' => $description,
                'created_at' => date('Y-m-d H:i:s')
            ];
    
            $this->spentModel->insert($data);
        
    
        // Redirecionar para a view 'index' no controlador 'Dash'
        return redirect()->to('/dash/index')->with('success', 'Gasto inserido com sucesso.');
    }
    

    public function recoverExpenses()
    {
         if (!$this->request->isAJAX()) {
             return redirect()->back();
        }

        $atributos = [
            'id',
            'value',
            'descricao',
            'created_at',
        ];

        $spents = $this->spentModel->select($atributos)->findAll();
        $data = [];
        foreach ($spents as $spent) {

            $data[] = [
                'id' => $spent->id,
                'value' => $spent->value,
                'descricao' => $spent->descricao,
                'created_at' => $spent->created_at,
            ];
        }
        $retorno = [
            'data' => $data
        ];

        // dd($retorno);

        return $this->response->setJSON($retorno);
    }
}
