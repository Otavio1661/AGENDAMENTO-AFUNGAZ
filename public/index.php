<?php
header("Access-Control-Allow-Origin: http://localhost:3001");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, Access-Control-Allow-Origin");
header("Access-Control-Allow-Credentials: true");
date_default_timezone_set('America/Sao_Paulo');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit();
}

ini_set('memory_limit', -1);
ini_set('max_execution_time', 0);

session_start();

require_once '../vendor/autoload.php';
require_once '../src/routes.php';

/**
 * Description of Rotina via CLI
 * aqui temos inicio da nossa aplicação via CLI, ela rece 2 parametros Token e rotina
 * ou seja vc vai chamar asim EX:  php index.php token-gazintech-jv-2022.h0tNFimH59WgtnEcu perda
 * lenbrando que é preciso passar ou estar no caminho absoluto da pasta
 *
 * como agendar ? bastar criar sua rotina normalmente e caso queria ela via CLI em vez de htttp, na
 * verdade ela vai funcionar dos dois modos basta vc cadastrar rota no routes.php mais caso contrario
 * vc pode add mesma no array de rotinas abaixo e definar chave e valor como no exemplo abaixo
 * @author joao.dasilva
 */

if (isset($argc)) {
    $rotinas = [
        'enviaPedido'                => 'PedidoController',
    ];

    $acesso = false;
    for ($i = 0; $i < $argc; $i++) {
        if ($i == 1 && $argv[$i] == 'token-gazintech-jv-2022.h0tNFimH59WgtnEcu') {
            $acesso = true;
        } else if ($i == 2 && !empty($argv[$i]) && $acesso) {
            $rotina = $argv[$i];
        }
    }

    if ($acesso && array_key_exists($rotina, $rotinas)) {
        $controller = "\src\controllers\\" . $rotinas[$rotina];
        $definedController = new $controller();
        $definedController->index();
        die;
    } else {
        header('Location: ./public');
        die;
    }
}


$router->run($router->routes);
