<?php

namespace src\helpers;

use core\Controller;
use Exception;
use src\Config;

/**
 * Envia email via API Gazin
 *
 * @author renan.delmonico
 * @author fabio.gomes
 */

class EmailApi extends Controller
{

    private $url = Config::URL_API_GAZIN . '/email';
    private $httpResponse;
    private $bodyResponse;
    private $origem;
    private $destino;
    private $assunto;
    private $conteudo;
    public $anexos = array();
    private $cc = array();

    public function getUrl()
    {
        return $this->url;
    }

    public function getHttpResponse()
    {
        return $this->httpResponse;
    }

    public function getBodyResponse()
    {
        return $this->bodyResponse;
    }

    public function getOrigem()
    {
        return $this->origem;
    }

    public function getDestino()
    {
        return $this->destino;
    }

    public function getAssunto()
    {
        return $this->assunto;
    }

    public function getConteudo()
    {
        return $this->conteudo;
    }

    /*
     * $Email->setAnexos(array(
            'base64' => base64_encode($itemxml['content']),
            'nome'   => $itemxml['name']
        ));
     */
    public function getAnexos()
    {
        return $this->anexos;
    }


    public function getCc()
    {
        return $this->cc;
    }

    public function setOrigem($origem)
    {
        $this->origem = $origem;
    }

    public function setDestino($destino)
    {
        $this->destino = $destino;
    }

    public function setAssunto($assunto)
    {
        $this->assunto = $assunto;
    }

    public function setConteudo($conteudo)
    {
        $this->conteudo = $conteudo;
    }

    public function setAnexos($anexos)
    {
        $this->anexos[] = $anexos;
    }

    public function setCc($cc)
    {
        $this->cc[] = $cc;
    }

    public function enviar()
    {
        $controller = new Controller();

        $json = json_encode(array(
            'origem'   => $this->getOrigem(),
            'destino'  => $this->getDestino(),
            'assunto'  => $this->getAssunto(),
            'conteudo' => $this->getConteudo(),
            'anexos'   => $this->getAnexos(),
            'cc'       => $this->getCc()
        ));

        $ch = curl_init($this->getUrl());

        curl_setopt_array($ch, array(
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => $json,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $controller->getTokenAPIGazin(),
                'Content-Length: ' . strlen($json))
        ));

        //Execute request
        $this->bodyResponse = curl_exec($ch);
        $this->httpResponse = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if($this->getHttpResponse() == 200){
            return true;
        }else{
            $error = json_decode($this->getBodyResponse());
            throw new Exception($error->mensagem, $this->getHttpResponse());
        }

    }
}