<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\VO\Usuario;
use App\Tests\Cadastro;

final class CadastroTest extends TestCase
{
    public function testFazerCadastro(): void
    {

        $usuario = new Usuario();
        $usuario->setNome('usuario test');
        $usuario->setApelido('usuario');
        $usuario->setEmail('usuario@email.com');
        $usuario->setTelefone('(00) 0 0000-0000');
        $usuario->setFotoPerfil('https://elaele.com.br/img/anonimo.png');

        $usuarioDAO = new Cadastro();
        $this->assertTrue($usuarioDAO->cadastrar($usuario));
    }
}