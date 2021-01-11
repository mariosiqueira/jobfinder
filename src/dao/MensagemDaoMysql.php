<?php
namespace App\Dao;
use App\VO\Mensagem; //Import do arquivo Mensagem.php para ser manipulado no banco de dados
use App\VO\MensagemDao;
use PDO;

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
        if($sql->execute()) {
            $mensagem->setId($this->pdo->lastInsertId());
            return $mensagem;
        }
        return null;

    }

    public function buscarMensagens($id){ //Recupera todos os mensagens recebidas e enviadas do usuário
        
        $sql = $this->pdo->prepare("SELECT * FROM mensagens WHERE contratante_id = :id or contratado_id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return $sql->fetchAll(); 
        }

        return false;
    }

    //O método a seguir deleta uma mensagem apenas pelo id do contratante
    public function deletarMensagemPeloContratanteId($id) {
        $sql = $this->pdo->prepare("DELETE FROM mensagens WHERE contratante_id = :contratante_id");
        $sql->bindValue(':contratante_id', $id);
        if($sql->execute()) {
            return true;
        }
        return false;
    }

    //O método a seguir deleta uma mensagem apenas pelo id do contratado
    public function deletarMensagemPeloContratadoId($id) {
        $sql = $this->pdo->prepare("DELETE FROM mensagens WHERE contratado_id = :contratado_id");
        $sql->bindValue(':contratado_id', $id);
        if($sql->execute()) {
            return true;
        }
        return false;
    }
}