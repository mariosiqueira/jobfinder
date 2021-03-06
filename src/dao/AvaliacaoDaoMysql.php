<?php
namespace App\Dao;
use App\VO\Avaliacao;
use App\VO\AvaliacaoDao;
use PDO;

class AvaliacaoDaoMysql implements AvaliacaoDao {
    /**
     * O PDO vai ser passado por parâmetro no arquivo que 
     * precisar instanciar essa classe AvaliacaoUsuarioDaoMysql.
     */
    private $pdo;

    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }
    
    /**
     * Os métodos concretos a seguir são obrigatórios para esta classe 
     * funcionar e foram implementados da interface UsuarioDao 
     * que está no arquivo Usuario.php da pasta vo.
     **/

    public function salvar(Avaliacao $avaliacao){
        //É melhor quebrar a query de inserção de dados, por questão de segurança. Onde tem :nome, :telefone...serão as máscaras para inserir os valores pelo bindValue
        $sql = $this->pdo->prepare("INSERT INTO avaliacoes (avaliacao, comentario, usuario_id, avaliador_id) VALUES (:avaliacao, :comentario, :usuario_id, :avaliador_id)");

        $sql->bindValue(":avaliacao", $avaliacao->getAvaliacao());
        $sql->bindValue(":comentario", $avaliacao->getComentario());
        $sql->bindValue(":usuario_id", $avaliacao->getUserId());
        $sql->bindValue(":avaliador_id", $avaliacao->getAvaliadorId());

        if($sql->execute()) {
            $avaliacao->setId($this->pdo->lastInsertId());
            return $avaliacao;
        }
        return null;
        
    }

    public function buscarAvaliacoesUsuario($id) { //pega todas as avaliaçoes de um usuário

        $sql = $this->pdo->prepare("SELECT * FROM avaliacoes WHERE usuario_id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            return $sql->fetchAll(); 
        }

        return false;
    }

}