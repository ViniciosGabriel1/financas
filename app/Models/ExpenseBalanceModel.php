<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpenseBalanceModel extends Model
{


    public function getUserExpenseBalanceData($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    public function insertOrUpdateExpenseBalance($userId, $amountSpent)
    {
        // Verificar se já existe um gasto registrado para o dia atual
        $today = date('Y-m-d');
        $existingSpent = $this->where('user_id', $userId)
            ->where('DATE(date)', $today)
            ->first();

        if ($existingSpent) {
            // Se houver um gasto existente, some o novo valor ao valor existente
            $newAmount = $existingSpent->balance + $amountSpent;

            // Atualize o registro existente com o novo valor
            $this->update($existingSpent->id, ['balance' => $newAmount]);
        } else {
            // Se não existir um gasto para o dia atual, insira um novo registro
            $data = [
                'user_id' => $userId,
                'balance' => $amountSpent,
                'date' => date('Y-m-d H:i:s')
            ];
            $this->insert($data);
        }
    }


    protected $table            = 'expense_balance';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'balance', 'date'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;

    // protected array $casts = [];
    // protected array $castHandlers = [];

    // // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
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
