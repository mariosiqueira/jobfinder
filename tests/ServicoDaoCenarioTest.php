<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\VO\Servico;
use App\Tests\ServicoDaoCenario;

final class ServicoDaoCenarioTest extends TestCase
{
    public function testSalvaServico(): void
    {
        // Método usando para pular esse test
        $this->markTestIncomplete(
            'Ignorando o test de salvar serviço para nao persistir no banco.'
        );

        $servico = new Servico();
        $servico->setTitulo('servico test');
        $servico->setDescricao('descrição serviço teste');
        $servico->setEnderecoServico('endereço teste');
        $servico->setValor(100.53);
        $servico->setStatus("aberto");
        $servico->setUsuarioId(1); //id de um usuario cadastrado no banco

        $dao = new ServicoDaoCenario();
        $this->assertNotNull($dao->cadastrar($servico)); //É esperado que o serviço seja criado com sucesso
    }

    public function testSalvaServicoErro(): void
    {
        $servico = new Servico();
        $servico->setTitulo('servico test');
        $servico->setDescricao('descrição serviço teste');
        $servico->setEnderecoServico('endereço teste');
        $servico->setValor(100.53);
        $servico->setStatus("aberto");
        //$servico->setUsuarioId(2); //id de um usuario cadastrado no banco

        $dao = new ServicoDaoCenario();
        $this->assertNull($dao->cadastrar($servico)); //É esperado null pq não foi passado o id do usuario que criou o serviço 
    }

    public function testDelatarServico() :void
    {
        // Método usando para pular esse test
        $this->markTestIncomplete(
            'Ignorando o test de deletar serviço para nao persistir no banco.'
        );
        $dao = new ServicoDaoCenario();

        $this->assertTrue($dao->deletar(1)); // é esperado o retorno true ao deletar um serviço válido
    }

    public function testDelatarServicoInexistente() :void
    {
        $dao = new ServicoDaoCenario();

        //foi utilizado um id de um serviço que não existe no banco de dados.
        $idInvalido = 100;

        $this->assertNotTrue($dao->deletar($idInvalido)); // é esperado o retorno diferente de true ao deletar um serviço inválido.
    }

    public function testUpdateServico() :void
    {
        $dao = new ServicoDaoCenario();

        //id de um serviço válido do banco 
        $idServico = 1;

        // criando novos dados pra editar o serviço
        $novosDados = array(
            "titulo" => "Novo titulo update teste 1",
            "descricao" => "Nova descrição update teste 1",
            "enderecoServico" => "Novo endereço update teste 1",
        );

        $this->assertTrue($dao->atualizar($idServico, $novosDados)); // é esperado o retorno de true ao atualizar o serviço.
    }

    public function testUpdateServicoInexistente() :void
    {
        $dao = new ServicoDaoCenario();

        //id de um serviço inválido do banco 
        $idServico = 100;

        // criando novos dados pra editar o serviço
        $novosDados = array(
            "titulo" => "Novo titulo update teste 2",
            "descricao" => "Nova descrição update teste 2",
            "enderecoServico" => "Novo endereço update teste 2",
        );

        $this->assertNotTrue($dao->atualizar($idServico, $novosDados)); // é esperado o retorno diferente de true ao atualizar o serviço com id inválido.
    }
}