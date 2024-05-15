<?php

namespace App\Models;

use CodeIgniter\Model;

class SpentModel extends Model
{
    protected $table = 'spent';

    public function getUserSpentData($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    // No seu modelo SpentModel

    public function getFirstExpenseMonth($userId)
    {
        // Selecionar a data (mês) do primeiro gasto registrado pelo usuário
        $this->select('DATE_FORMAT(MIN(created_at), "%Y-%m") as first_expense_month');
        $this->where('user_id', $userId);
        return $this->first()->first_expense_month ?? null;
    }

    public function getPreviousMonthExpenses($userId)
    {
        // Selecionar os gastos do mês anterior do usuário
        $firstExpenseMonth = $this->getFirstExpenseMonth($userId);
        if ($firstExpenseMonth) {
            // Calcular o mês anterior ao mês do primeiro gasto
            $previousMonth = date('Y-m', strtotime($firstExpenseMonth . ' -1 month'));

            // Selecionar os gastos do mês anterior
            return $this->where('user_id', $userId)
                ->where('DATE_FORMAT(created_at, "%Y-%m")', $previousMonth)
                ->findAll();
        }
        return [];
    }

    public function resetExpenses($userId)
    {
        // Reinicializar os gastos do usuário para o novo mês
        return $this->where('user_id', $userId)
            ->where('DATE_FORMAT(created_at, "%Y-%m") !=', date('Y-m'))
            ->delete();
    }




    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['value', 'user_id', 'descricao', 'created_at'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;

    // protected array $casts = [];
    // protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];
}
