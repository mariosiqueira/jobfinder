<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\VO\Usuario;
use App\Tests\UsuarioCadastro;

final class UsuarioCadastroTest extends TestCase
{
    public function testFazerCadastro(): void
    {

        $usuario = new Usuario();
        $usuario->setNome('usuario test');
        $usuario->setApelido('usuario');
        $usuario->setEmail('usuario@email.com');
        $usuario->setTelefone('(00) 0 0000-0000');
        $usuario->setFotoPerfil('default-user-img.jpg');

        $dao = new UsuarioCadastro();
        $this->assertTrue($dao->cadastrar($usuario)); //retorna true se conseguir salvar o usuario e false se nao conseguir;
    }
}