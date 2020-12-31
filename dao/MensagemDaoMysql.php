<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/jobfinder/vo/Mensagem.php';

class MensagemDaoMysql implements MensagemDao {
    /**
     * O PDO vai ser passado por parâmetro no arquivo que
     * precisar instanciar essa classe ServicosDaoMysql.
     */
    private $pdo;

    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }

    /**
     * Os métodos concretos a seguir são obrigatórios para esta classe
     * funcionar e foram implementados da interface ServicosDao
     * que está no arquivo Servicos.php da pasta vo.
     **/

    public function salvar(Mensagem $mensagem){
        //é melhor quebrar a query de insersão de dados, por questão de segurança. Onde tem :titulo, :descricao...serão as máscaras para inserir os valores pelo bindValue
        $sql = $this->pdo->prepare("INSERT INTO mensagens (contratante_id, contratado_id, mensagem) VALUES (:contratante_id, :contratado_id, :mensagem)");
        $sql->bindValue(":contratante_id", $mensagem->getContratanteId());
        $sql->bindValue(":contratado_id", $mensagem->getContratadoId());
        $sql->bindValue(":mensagem", $mensagem->getMensagem());
        $sql->execute();

        $mensagem->setId($this->pdo->lastInsertId());
        return $mensagem;
    }
}
