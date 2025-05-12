<?php

namespace core;

use Exception;
use \src\Config;

class Controller
{

    protected function redirect($url)
    {
        header("Location: " . $this->getBaseUrl() . $url);
        exit;
    }

    protected function getTokenAPIGazin()
    {
        try {
            $API_GAZIN_USERNAME = Config::API_GAZIN_USERNAME;
            $API_GAZIN_PASSWORD = Config::API_GAZIN_PASSWORD;
            $ch = curl_init('http://api.gazin.com.br/login');
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Accept: application/json',
                'Access-Control-Allow-Origin: *',
                'Content-Type: application/json'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            curl_setopt($ch, CURLOPT_UNRESTRICTED_AUTH, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("user" => $API_GAZIN_USERNAME, "pass" => $API_GAZIN_PASSWORD)));
            $result = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($result, true);
            return $response['token'];
        } catch (Exception $e) {
            throw new Exception('Falha ao gerar o token: ' . $e->getMessage());
        }
    }
    
    private function getBaseUrl()
    {
        $base = (isset($_SERVER['HTTP']) && strtolower($_SERVER['HTTP']) == 'on') ? 'http://' : 'http://';
        $base .= $_SERVER['SERVER_NAME'];
        if ($_SERVER['SERVER_PORT'] != '80') {
            $base .= ':' . $_SERVER['SERVER_PORT'];
        }
        $base .= Config::BASE_DIR;

        return $base;
    }

    private function _render($folder, $viewName, $viewData = [])
    {
        if (file_exists('../src/views/' . $folder . '/' . $viewName . '.php')) {
            extract($viewData);
            $render = fn($vN, $vD = []) => $this->renderPartial($vN, $vD);
            $base = $this->getBaseUrl();
            require '../src/views/' . $folder . '/' . $viewName . '.php';
        }
    }

    private function renderPartial($viewName, $viewData = [])
    {
        $this->_render('partials', $viewName, $viewData);
    }

    public function render($viewName, $viewData = [])
    {
        $this->_render('pages', $viewName, $viewData);
    }

    /**
     * recebe um array e verifica item vazios se tiver algum vazio retorna true
     * @param array $error
     */
    public function AllVazio($error)
    {
        foreach ($error as $it) {
            if (empty($it) || is_null($it)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Verifica se há campos vazios ou não presentes na lista de campos a serem validados.
     * @param array $campos  Array associativo com os campos e seus respectivos valores a serem verificados.
     * @param array $validar Lista de campos obrigatórios a serem verificados.
     * @return bool Retorna true se todos os campos obrigatórios estiverem preenchidos, caso contrário, rejeita a resposta.
     */
    public static function verificarCamposVazios($campos, $validar)
    {
        if (empty($campos) || !is_array($campos) || !is_array($validar)) {
            throw new Exception('Nenhum campo encontrado', 400);
        }
        // Verifica se os campos obrigatórios estão presentes e preenchidos
        foreach ($validar as $key) {
            if (!array_key_exists($key, $campos)) {
                throw new Exception('Campo obrigatório não encontrado: ' . $key, 400);
            }
            if (is_array($campos[$key])) {
                if (empty($campos[$key])) {
                    throw new Exception('Campo obrigatório vazio: ' . $key, 400);
                }
            } else {
                if (!isset($campos[$key]) || empty(trim($campos[$key]))) {
                    throw new Exception('Campo obrigatório vazio: ' . $key, 400);
                }
            }
        }

        return true;
    }

    /**
     * define status e respota para usuario
     * @param array $item
     * @param int $status
     */


    public static function response($item, $status, $pure = false)
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($status);
        if ($pure == true) {
            echo $item;
        } else {
            echo json_encode([
                'status' => $status,
                'retorno' => $item
            ]);
        }
        die;
    }

    public static function getBody(): ?array
    {
        header('Content-Type: application/json; charset=utf-8');
        $body = file_get_contents('php://input');
        return json_decode($body, true);
    }

    public static function rejectresponse($e)
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($e->getCode());

        echo json_encode([
            'status' => 'erro',
            'retorno' => $e->getMessage()
        ]);
    }
}
