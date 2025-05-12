<?php

namespace core;

use \src\Config;
use \src\handlers\UserHandlers;
use \core\Controller as ctrl;
use \src\models\Usuarios as Users;

class Auth extends ctrl
{
    public function validaToken($token)
    {
        $check = new UserHandlers();
        if ($check->checkLogin()) {
            return;
        }

        if (!$token || empty($_SESSION['token']) || !$check->checkLogin()) {
            self::VALIDATION();
        }

        $authHeaderParts = explode(' ', $token);
        $token = $authHeaderParts[1];

        $autorization = Users::getUserToken($token);
        if (empty($autorization)) {
            $this->VALIDATION();
        }
    }

    public function VALIDATION()
    {
        $this->redirect('error-404');
    }
}
