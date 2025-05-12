<?php
/* 3 parametro define se rota e privada ou não passar token jwt cadastrado no config.php por enqunato */

use core\Router;
use src\controllers\PermissoesSalasController;

$router = new Router();

//-----------------HOME-----------------//
$router->get('/', 'HomeController@home');
