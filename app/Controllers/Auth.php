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
        
        // V

            // Verificar se $senha é uma string antes de prosseguir
            $validated = $this->validate([
                'email' => 'required|valid_email',
                'senha' => 'required'
            ]);

            if(!$validated){
                return redirect()->route('auth/login_form')->with('error', $this->validator->getErrors()); 
            }

            $user = new UsuarioModel();
            $userFound = $user->select('id,username,email,password')->where('email',$this->request->getPost('email'))->first();
            // var_dump($userFound);

            if(!$userFound){
                return redirect()->route('auth/login_form')->with('msg', 'E-mail ou Senha incorretos.'); 
            }
            $senhaDigitada = $this->request->getPost('senha');

            if (password_verify(esc($senhaDigitada), $userFound->password)) {
                // Senha correta, faça o que for necessário
                unset($userFound->password);
                session()->set('user', $userFound);
    
    
                return redirect()->route('dash/index');

            } else {
                return redirect()->route('auth/login_form')->with('login', 'Login não efetuado !'); 

                // Senha incorreta, tratamento adequado, como redirecionamento ou exibição de mensagem de erro
            }
            
        
    }

    public function logout()
    {
        // Obter a instância da sessão
        $session = session();

        // Remover os dados da sessão do usuário
        $session->remove(['user_id', 'username']);

        // Redirecionar o usuário para a página de login ou para a página inicial
        return redirect()->to('auth/login_form');
    }
}
