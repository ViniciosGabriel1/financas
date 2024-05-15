<?php

namespace App\Models;

use CodeIgniter\Model;

class MonthlyExpensesModel extends Model
{
    protected $table = 'monthly_expenses';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'year', 'month', 'total', 'created_at'];
    protected $returnType= 'object';



    // public function insertMonthlyExpenses($userId, $year, $month, $total)
    // {
    //     $data = [
    //         'user_id' => $userId,
    //         'year' => $year,
    //         'month' => $month,
    //         'total' => $total,
    //     ];

    //     return $this->insert($data);
    // }

    
}
