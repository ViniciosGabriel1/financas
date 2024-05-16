<?php

namespace App\Models;

use CodeIgniter\Model;

class PiggyModel extends Model
{
    protected $table = 'piggy';
    
    public function getUserPiggyData($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    public function insertOrUpdateGoal($userId, $title, $goal, $dueDate)
    {
        // Verificar se já existe um objetivo financeiro para o usuário
        $existingGoal = $this->where('user_id', $userId)->first();
    
        if ($existingGoal) {
            // Se já existe, atualize os dados do objetivo
            $this->update($existingGoal->id, [
                'goal_title' => $title,
                'goal' => $goal,
                'due_date' => $dueDate
            ]);
    
            // Envie mensagem de sucesso para atualização
            return 'Porquinho financeiro atualizado com sucesso.';
        } else {

            // Se não existe, insira um novo registro
            $data = [
                'user_id' => $userId,
                'goal_title' => $title,
                'goal' => $goal,
                'due_date' => $dueDate
            ];
            $this->insert($data);
    
            // Envie mensagem de sucesso para inserção
            return 'Objetivo financeiro criado com sucesso.';
        }
    }
    


    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['value','goal','user_id','due_date','goal_title'];

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
