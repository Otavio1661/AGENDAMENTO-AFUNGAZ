<?php

namespace src\handlers;

use Exception;
use \src\models\Users;
use \core\Controller as ctrl;

class UserHandlers extends ctrl
{
    public $user;

    /**
     * Construtor da classe UserHandlers.
     */
    public function __construct()
    {
        $this->user = new Users;
    }

    /**
     * Verifica se o usuário está logado com base no token de sessão.
     *
     * @return bool Retorna true se o usuário estiver logado, caso contrário, retorna false.
     */
    public function checkLogin()
    {
  
        if (!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];
            $data = $this->user->getUserToken($token);
            if ($data && count($data) > 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * Verifica se o nome de usuário e a senha fornecidos são válidos.
     *
     * @param string $nome O nome de usuário fornecido
     * @param string $senha A senha fornecida
     * @return array|false Retorna um array contendo informações do usuário, incluindo o token, se a autenticação for bem-sucedida; caso contrário, retorna false.
     */
    public function verifyLogin($nome, $senha)
    {
        $user = $this->user->getUserlogin($nome, $senha);
        if(empty($user)) {
            throw new Exception('nome e/ou senha não conferem!');
        }

        if (sha1($senha) != $user['senha']) {
            throw new Exception('senha incorreta!');
        }

        $token = md5(time() . rand(0, 9999) . time());
        $this->user->saveToken($token,$user['idusuario']);
        $user['token'] = $token;
        $_SESSION['token'] = $token;
        return $user;
    }

}


