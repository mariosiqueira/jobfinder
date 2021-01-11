<?php

namespace App\Tests;

use App\Config\Conexao;
use App\Dao\UsuarioDaoMysql;
use App\VO\Usuario;

class UsuarioDaoCenario
{
    public function cadastrar(Usuario $usuario)
    {
        $usuarioDaoMysql = new UsuarioDaoMysql(Conexao::getInstance());

        return $usuarioDaoMysql->salvar($usuario);
    }

    public function logar($email, $senha)
    {
        $usuarioDaoMysql = new UsuarioDaoMysql(Conexao::getInstance());

        $aux = $usuarioDaoMysql->buscarPeloEmail($email);

        if($aux) { //Se encontrou usuário com o e-mail fornecido
            return $aux->getSenha() == $senha ? true : false;
        } else {
            return null;
        } 
    }
}