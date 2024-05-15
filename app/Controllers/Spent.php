<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ExpenseBalanceModel;
use App\Models\MonthlyExpensesModel;
use App\Models\SpentModel;
use CodeIgniter\HTTP\ResponseInterface;

class Spent extends BaseController

{
    private $spentModel;
    private $expenseBalanceModel;
    private $monthlyExpenseModel;


    public function __construct()
    {
        $this->spentModel = new SpentModel();

        $this->expenseBalanceModel = new ExpenseBalanceModel();
        $this->monthlyExpenseModel = new MonthlyExpensesModel();
    }
    public function spent_form()
    {

        return view('forms/spent_form');
    }

// No seu controller

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

    // Inserir o novo gasto
    $data = [
        'user_id' => $userId,
        'value' => $amountSpent,
        'descricao' => $description,
        'created_at' => date('Y-m-d H:i:s')
    ];
    $this->spentModel->insert($data);

    // Verificar se o mês virou e processar os gastos do mês anterior
    $this->processPreviousMonthExpenses($userId);

    // Redirecionar para a view 'index' no controlador 'Dash'
    return redirect()->to('/dash/index')->with('success', 'Gasto inserido com sucesso.');
}

private function processPreviousMonthExpenses($userId)
{
    // Obter a data (mês) do primeiro gasto registrado
    $firstExpenseDate = $this->spentModel->getFirstExpenseMonth($userId);

    // Obter o mês atual
    $currentMonth = date('Y-m');

    // Verificar se o mês atual é diferente do mês do primeiro gasto
    if ($currentMonth != $firstExpenseDate) {
        // O mês virou, processar os gastos do mês anterior

        // Obter os gastos do mês anterior
        $previousMonthExpenses = $this->spentModel->getPreviousMonthExpenses($userId);

        // Calcular a soma dos gastos do mês anterior
        $totalPreviousMonthExpenses = 0;
        foreach ($previousMonthExpenses as $expense) {
            $totalPreviousMonthExpenses += $expense->value;
        }

        // Salvar o total dos gastos do mês anterior na tabela monthly_expense
        $monthlyExpenseData = [
            'user_id' => $userId,
            'total_expenses' => $totalPreviousMonthExpenses,
            'month' => $firstExpenseDate, // Mês do primeiro gasto
        ];
        $this->monthlyExpenseModel->insert($monthlyExpenseData);

        // Reinicializar os gastos do usuário para o novo mês
        $this->spentModel->resetExpenses($userId);
    }
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
