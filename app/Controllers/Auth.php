<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login_form');
    }


    protected $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
    }

    public function login_submit()
    {


        // Verificar se os dados do formulário foram submetidos
        if ($this->request->getMethod() === 'POST') {
            // Recuperar os dados do formulário
            $email = $this->request->getPost('email');
            $senha = $this->request->getPost('senha');


            // Verificar se $senha é uma string antes de prosseguir
            if (is_string($senha)) {
                // Verificar se o usuário existe no banco de dados
                $usuario = $this->usuarioModel->where('email', $email)->first();
                // Depuração para verificar o conteúdo de $usuario

                if ($usuario && password_verify($senha, $usuario['password'])) {
                    // Usuário autenticado com sucesso
                    // Faça o que precisar, como definir uma sessão de usuário
                    $session = session();
                    $userData = [
                        'user_id' => $usuario['id'],
                        'username' => $usuario['username'],
                        // Adicione quaisquer outros dados de usuário que deseja armazenar na sessão
                    ];
                    $session->set($userData);
                    return redirect()->to('dada');
                } else {
                    // Credenciais inválidas, redirecionar de volta para o formulário de login com uma mensagem de erro
                    return redirect()->back()->with('error', 'Credenciais inválidas. Por favor, tente novamente.');
                }
            } else {
                // $senha não é uma string, trata como uma submissão inválida
                return redirect()->back()->with('error', 'Erro ao processar o formulário de login. Por favor, tente novamente.');
            }
        }

        // Carregar a view do formulário de login
        return redirect()->to('auth/login_submit');
        echo "show";
    }
}
