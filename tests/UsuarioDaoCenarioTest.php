<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\VO\Usuario;
use App\Tests\UsuarioDaoCenario;

final class UsuarioDaoCenarioTest extends TestCase
{
    public function testFazerCadastro(): void
    {
        // Método usando para pular esse test
        $this->markTestIncomplete(
            'Ignorando o test de salvar usuário para nao persistir no banco.'
        );

        $usuario = new Usuario();
        $usuario->setNome('usuario test');
        $usuario->setApelido('usuario');
        $usuario->setTelefone('(00) 0 0000-0000');
        $usuario->setEmail('usuario@email.com'); //o e-mail deve ser unique
        $usuario->setSenha(md5('12345'));
        $usuario->setFotoPerfil('default-user-img.jpg');

        $dao = new UsuarioDaoCenario();
        $this->assertNotNull($dao->cadastrar($usuario)); //É esperado que nao retorne null
    }

    public function testFazerCadastroEmailExistente(): void
    {
        $usuario = new Usuario();
        $usuario->setNome('usuario test');
        $usuario->setApelido('usuario');
        $usuario->setTelefone('(00) 0 0000-0000');
        $usuario->setEmail('usuario@email.com'); //usando e-mail já existente
        $usuario->setSenha(md5('12345'));
        $usuario->setFotoPerfil('default-user-img.jpg');

        $dao = new UsuarioDaoCenario();
        $this->assertNull($dao->cadastrar($usuario)); //É esperado que retorne null porque o e-mail já está cadastrado
    }

    public function testLogarCorretamente(): void
    {
        $email = "usuario@email.com";
        $senha = md5("12345");

        $dao = new UsuarioDaoCenario();
        $this->assertTrue($dao->logar($email, $senha));
    }

    public function testLogarSenhaIncorreta(): void
    {
        $email = "usuario@email.com";
        $senha = md5("senhaerrada");

        $dao = new UsuarioDaoCenario();
        $this->assertFalse($dao->logar($email, $senha)); //Deve retornar false caso seja passado uma senha incorreta
    }

    public function testLogarEmailIncorretoOuInexistente(): void
    {
        $email = "usuario@email.co";
        $senha = md5("12345");

        $dao = new UsuarioDaoCenario();
        $this->assertNull($dao->logar($email, $senha)); //Deve retornar null caso seja passado um e-mail incorreto ou um e-mail de usuario que não seja cadastrado
    }

}