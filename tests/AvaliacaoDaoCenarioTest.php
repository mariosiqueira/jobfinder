<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\VO\Avaliacao;
use App\Tests\AvaliacaoDaoCenario;

final class AvaliacaoDaoCenarioTest extends TestCase
{
    public function testSalvarAvaliacao(): void
    {
        // Método usando para pular esse test
        $this->markTestIncomplete(
            'Ignorando o test de salvar serviço para nao persistir no banco.'
        );
        $contratadoId = 1; //Id válido do usuario teste
        $contratanteId = 23; //Id válido de um contratante que avalia o serviço do contratado
        $valorAvaliacao = 4;

        $avaliacao = new Avaliacao();
        $avaliacao->setComentario('Excelente prestador de serviço. Recomendo Usuário Teste!');
        $avaliacao->setAvaliacao($valorAvaliacao);
        $avaliacao->setUserId($contratadoId);
        $avaliacao->setAvaliadorId($contratanteId);

        $dao = new AvaliacaoDaoCenario();
        $this->assertNotNull($dao->cadastrar($avaliacao)); //É esperado que a avaliação seja cadastrada com sucesso
    }

    public function testSalvarAvaliacaoErroAvaliador(): void
    {
        $contratadoId = 1; //Id válido do usuario teste
        $contratanteId = -1; //Id inválido de um contratante que avalia o serviço do contratado
        $valorAvaliacao = 4;

        $avaliacao = new Avaliacao();
        $avaliacao->setComentario('Excelente prestador de serviço. Recomendo Usuário Teste!');
        $avaliacao->setAvaliacao($valorAvaliacao);
        $avaliacao->setUserId($contratadoId);
        $avaliacao->setAvaliadorId($contratanteId);

        $dao = new AvaliacaoDaoCenario();
        $this->assertNull($dao->cadastrar($avaliacao)); //Um valor null é esperado por passar um id de um contratante inválido
    }

    public function testSalvarAvaliacaoErroComentario(): void
    {
        $contratadoId = 1; //Id válido do usuario teste
        $contratanteId = 23; //Id inválido de um contratante que avalia o serviço do contratado
        $valorAvaliacao = 4;

        $avaliacao = new Avaliacao();
        $avaliacao->setComentario(null); //Comentário nulo
        $avaliacao->setAvaliacao($valorAvaliacao);
        $avaliacao->setUserId($contratadoId);
        $avaliacao->setAvaliadorId($contratanteId);

        $dao = new AvaliacaoDaoCenario();
        $this->assertNull($dao->cadastrar($avaliacao)); //Um valor null é esperado porque o comentário é nulo
    }

    public function testBuscarAvaliacaoUsuario(): void
    {
        $usuarioId = 1; //Usuário id existente de teste

        $dao = new AvaliacaoDaoCenario();
        $this->assertNotNull($dao->buscarAvaliacaoUsuario($usuarioId)); //Um retorno não nulo é esperado caso esse usuário tenha alguma avaliação
    }

    public function testBuscarAvaliacaoUsuarioErro(): void
    {
        $usuarioId = -1; //Usuário id inexistente

        $dao = new AvaliacaoDaoCenario();
        $this->assertFalse($dao->buscarAvaliacaoUsuario($usuarioId)); //Um retorno false é esperado pelo fato do usuário não existir
    }

}