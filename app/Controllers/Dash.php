<?php

namespace App\Controllers;

use App\Models\PiggyModel;
use App\Models\SpentModel;
use App\Models\SalaryModel;
use App\Models\BalanceModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dash extends BaseController
{
    public function index()
    {
        if (!session()->has('user')) {
            // Usuário não autenticado, redirecionar para a página de login
            return redirect()->to('auth/login_form');
        }
    
        $userId = session()->get('user')->id;
    
        $spentModel = new SpentModel();
        $amount_spent = $spentModel->getUserSpentData($userId);
    
        $balanceModel = new BalanceModel();
        $balance = $balanceModel->getUserBalanceData($userId);
    
        $salaryModel = new SalaryModel();
        $salary = $salaryModel->getUserSalaryData($userId);
    
        $piggyModel = new PiggyModel();
        $piggyData = $piggyModel->getUserPiggyData($userId);
    
        // Criar uma array pai contendo os dados dos gastos, saldo, salário e piggy
        $data = [
            'amount_spent' => $amount_spent,
            'balance' => $balance,
            'salary' => $salary,
            'piggy' => $piggyData
        ];
    
        // Carregar a view passando os dados recuperados
        return view('dash/index', $data);
    }
    


}
