<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\ResponseInterface;

class Register extends BaseController
{

    protected $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
    }



    public function register()
    {
        return view('register/register_form');
    }

    public function register_submit()
    {
        // Verificar se os dados do formulário foram submetidos via POST
        if ($this->request->getMethod() === 'POST') {
            // Recuperar os dados do formulário
            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
    
            // Verificar se todos os campos foram preenchidos
            if (empty($username) || empty($email) || empty($password)) {
                return redirect()->back()->with('error', 'Por favor, preencha todos os campos.');
            }
    
            // Verificar se o email é válido
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return redirect()->back()->with('error', 'Por favor, insira um email válido.');
            }
    
            // Verificar se o usuário já existe no banco de dados
            $existingUser = $this->usuarioModel->where('email', $email)->first();
            if ($existingUser) {
                return redirect()->back()->with('error', 'Este email já está sendo usado por outra conta.');
            }
    
            // Hash da senha antes de salvar no banco de dados
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            // Salvar os dados do novo usuário no banco de dados
            $userData = [
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword,
                // Adicione outros campos do usuário aqui, se necessário
            ];
            $this->usuarioModel->insert($userData);
    
            // Redirecionar para a página de sucesso ou exibir uma mensagem
            return redirect()->to('/success')->with('success', 'Usuário cadastrado com sucesso!');
        }
    
        // Se não foi uma solicitação POST, redirecionar de volta para a página de registro
        return redirect()->to('/register')->with('error', 'Erro ao processar o formulário de registro. Por favor, tente novamente.');
    }
    
}
