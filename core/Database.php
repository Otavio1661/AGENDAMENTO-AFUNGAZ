<?php

namespace core;

use \src\Config;
use PDO;

class Database {

    
    private static $_pdo;

     /**
     * Chama o banco cadastro em Config.php
     * se parametro $db for passado, e for uma numero idFilial, chama o banco da filial
     * @param string $db
     */
    public static function getInstance() {
        if(!self::$_pdo){  // se for um número, é uma filial
            $cx = Config::SB_DRIVER.":host=".Config::SB_HOST.";port=".Config::SB_PORT.";dbname=".Config::SB_DATABASE;
            self::$_pdo = new \PDO($cx, Config::SB_USER, Config::SB_PASS);
            self::$_pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);
            self::$_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		
        return self::$_pdo;
    }

    /**
     * Retorna ou executa um SQL
     * se penultimo for false retorna SQL com parametros subtituidos
     * ultimo parametro ira logar SQL e retorno do mesmo nos LOGs caso seja true
     * sempre verificar tipos dos campos nos Parametros do SQL EX:int,string ...
     * retorno array ['retorno']
     * erro em ['error']
     * @param array   $params
     * @param string  $sqlnome
     * @param boolean $exec
     * @param boolean $log
     *
     * @return array ['retorno']
     */
    public static function switchParams($params, $sqlnome, $exec=false, $log=false, $sqlPrm = '', $asObject=0 ) {

        $sql = $sqlPrm != '' ? $sqlPrm : file_get_contents('../src/SQL/'.$sqlnome.'.sql');
        $res = [
            'retorno' => false,
            'error' => false,
        ];
        
        try {
            $pdo = self::getInstance();
            if(!empty($params)){
                foreach($params as $nome => $valor){
                    @$rpl = str_replace('\"', "'", $valor);
                    $valor = is_string($valor)? trim($rpl) : $valor;
                    @$sql = preg_replace( '/:'.(string)$nome.'\b/i', $valor, $sql);
                };
            }
            $sql = str_replace('idsql=', 'idsql=E', $sql);
            if($exec){
                $sql = "SET NAMES 'UTF-8';".$sql; //TRATAMENTO DE ENCODE UTF-8
                $pdo->beginTransaction();		
                $stmt = $pdo->query($sql);
				
                if($asObject==1){
				  $res['retorno'] = $stmt->fetchObject();	
				}else{
				  $res['retorno'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);	
				}
                
                $pdo->commit();
            }else{
                $res['retorno'] = $sql;
            }

            if($log){
                $logjv = [
                    'data' => date('Y-m-d H:i:s'),
                    'sql'  => $sql,
                    'params' => $params,
                    'res'  => $res['retorno']
                ];
                file_put_contents('../logs/exec'.date('Y-m-d').'-sql.txt',print_r($logjv, true),FILE_APPEND);
            }

        }catch( \Exception $e ){
            $pdo->rollBack();
            $logjv = [
                'data' =>date('Y-m-d H:i:s'),
                'msg'  => $e->getMessage(),
                'sql'=>$sql
            ];
            file_put_contents('../logs/error'.date('Y-m-d').'-sql.txt',print_r($logjv, true),FILE_APPEND);
            $res['error'] = $e->getMessage();
        }

        unset($pdo);
        return $res;
    }
	
    public function __construct() { }
    public function __clone() { }
    public function __wakeup() { }
}
