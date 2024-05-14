<?php

namespace App\Controllers;

use App\Models\PiggyModel;
use App\Models\SpentModel;
use App\Models\SalaryModel;
use App\Models\BalanceModel;
use App\Controllers\BaseController;
use App\Models\ExpenseBalanceModel;
use CodeIgniter\HTTP\ResponseInterface;

class Dash extends BaseController

{   
    private $spentModel;
    private $balanceModel;
    private $salaryModel;
    private $piggyModel;
    private $expenseBalanceModel;



    public function __construct() {
        $this->spentModel = new SpentModel();
        $this->balanceModel = new BalanceModel();
        $this->salaryModel = new SalaryModel();
        $this->piggyModel = new PiggyModel();
        $this->expenseBalanceModel = new ExpenseBalanceModel();
    }
    
    public function index()
    {
        if (!session()->has('user')) {
            // Usuário não autenticado, redirecionar para a página de login
            return redirect()->to('auth/login_form');
        }
    
        $userId = session()->get('user')->id;
    
        $amount_spent = $this->spentModel->getUserSpentData($userId);
        $balance = $this->balanceModel->getUserBalanceData($userId);
        $salary = $this->salaryModel->getUserSalaryData($userId);
        $piggyData = $this->piggyModel->getUserPiggyData($userId);
        $expenseBalanceData = $this->expenseBalanceModel->getUserExpenseBalanceData($userId);
        
    
        // Criar uma array pai contendo os dados dos gastos, saldo, salário e piggy
        $data = [
            'amount_spent' => $amount_spent,
            'balance' => $balance,
            'salary' => $salary,
            'piggy' => $piggyData,
            'expense_balance' => $expenseBalanceData,
        ];
    
        // Carregar a view passando os dados recuperados
        return view('dash/index', $data);
    }
    


}
