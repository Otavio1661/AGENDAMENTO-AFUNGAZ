<?php

namespace src\models;

use core\Database;
use PDO;

/**
 * Classe modelo para a tabela 'Usuarios' do banco de dados.
 *
 * @author joaosn
 * @date 11/05/20254
 */
class Users 
{
    
    public static function getUserToken($token)
    {
        $res = Database::switchParams(['token'=>$token],'users/getUsuarioToken',true,true);
        return $res['retorno'][0] ?? false;
    }

    
    public static function getUserlogin($nome, $senha)
    {
        $dados = Database::switchParams([$nome, $senha],'users/getUsuarioLogin',true,true);
        return $dados['retorno'][0] ?? false;
    }

    /**
     * Atualiza o token de autenticação para um usuário específico com base no nome fornecido.
     *
     * @param string $token O novo token de autenticação
     * @param string $nome O nome de usuário do usuário cujo token será atualizado
     */
    public static function saveToken($token, $usuario)
    {
        Database::switchParams(['token'=>$token,'idusuario'=>$usuario],'users/saveToken',true,true);
    }

}
