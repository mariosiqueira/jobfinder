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
}