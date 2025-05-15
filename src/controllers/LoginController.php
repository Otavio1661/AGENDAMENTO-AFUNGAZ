<?php


namespace src\controllers;

use \core\Controller as ctrl;
use Exception;
use \src\handlers\UserHandlers;
use \src\models\Users;


class LoginController extends ctrl
{

    public $helpUser;

    public function verificarLogin()
    {
        try {
            $data = ctrl::getBody();
            
            if (empty($data['usuario']) && !isset($data['senha'])) {
                throw new Exception('Prencha dados corretamente!');
            }
            
            $infos = $this->helpUser->verifyLogin($data['usuario'], $data['senha']);
            $_SESSION['usuario'] = $infos;
            
            
            ctrl::response('Login realizado com sucesso!', 200);
        } catch (Exception $e) {
            ctrl::response($e->getMessage(), 400);
        }
    }

    /**
     * Realiza o logout do usuário, removendo a sessão e redirecionando para a tela de login
     */
    public function logout()
    {

        try {
            if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {
                $usuarioModel = new Users();
                $usuario = $usuarioModel->getUserToken($_SESSION['token']);

                if ($usuario) {
                    $usuarioModel->saveToken(null, $usuario['idusuario']);
                }
            }

            unset($_SESSION);

            session_unset();
            session_destroy();

            $this->redirect('');
            exit;
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $this->redirect('');
            exit;
        }
    }
}