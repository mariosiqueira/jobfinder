<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/jobfinder/vo/Servico.php';

class ServicoDaoMysql implements ServicoDao {
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

    public function salvar(Servico $servico){
        //é melhor quebrar a query de insersão de dados, por questão de segurança. Onde tem :titulo, :descricao...serão as máscaras para inserir os valores pelo bindValue
        $sql = $this->pdo->prepare("INSERT INTO servicos (titulo, descricao, endereco_servico, valor, usuario_id) VALUES (:titulo, :descricao, :endereco_servico, :valor, :usuario_id)");
        $sql->bindValue(":titulo", $servico->getTitulo());
        $sql->bindValue(":descricao", $servico->getDescricao());
        $sql->bindValue(":endereco_servico", $servico->getEnderecoServico());
        $sql->bindValue(":valor", $servico->getValor());
        $sql->bindValue(":usuario_id", $servico->getUsuarioId());
        $sql->execute();

        $servico->setId($this->pdo->lastInsertId());
        return $servico;
    }

    public function buscarTodos(){
        $arrayServicos = [];

        $sql = $this->pdo->query("SELECT * FROM servicos");
        if($sql->rowCount() > 0){
            $arrayDadosServiços = $sql->fetchAll(); //Pega todos os dados dos serviços encontrados e joga no arrayDados

            foreach($arrayDadosServiços as $dadoServico){
                /**
                 * Deve-se construir objetos do tipo Servicos e preenchê-los com os dados
                 * advindos do banco com a consulta para adicionar ao arrayServicos e retornar
                 * **/
                $servico = new Servico();
                $servico->setId($dadoServico['id']);
                $servico->setTitulo($dadoServico['titulo']);
                $servico->setDescricao($dadoServico['descricao']);
                $servico->setEnderecoServico($dadoServico['endereco_servico']);
                $servico->setValor($dadoServico['valor']);
                $servico->setUsuarioId($dadoServico['usuario_id']);
                $servico->setDataPostagem($dadoServico['data_postagem']);

                $arrayServicos[] = $servico; //Adiciona o serviço construído e preenchido no arrayServiços que ao final da iteração será devolvido para quem chamou o método.
            }
        }
        return $arrayServicos;
    }

    public function buscarPeloId($id){
        $sql = $this->pdo->prepare("SELECT * FROM servicos WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if($sql->rowCount() > 0){
            $dadoServico = $sql->fetch(); //Pega os dados de um serviço que foi encontrado com o id passado por parâmetro e atribui à variável dadosServicos

            /**
             * Faz o processo de construção de um objeto servicos com os dados encontrados passando o id por parâmetro
             */

            $servico = new Servico();
            $servico->setId($dadoServico['id']);
            $servico->setTitulo($dadoServico['titulo']);
            $servico->setDescricao($dadoServico['descricao']);
            $servico->setEnderecoServico($dadoServico['endereco_servico']);
            $servico->setValor($dadoServico['valor']);
            $servico->setUsuarioId($dadoServico['usuario_id']);
            $servico->setDataPostagem($dadoServico['data_postagem']);

            return $servico;
        } else {
            return false;
        }

    }

    public function buscarServicoPeloIdDoUsuario($usuarioId) {
        $arrayServicos = [];
        $sql = $this->pdo->prepare("SELECT * FROM servicos WHERE usuario_id = :usuario_id");
        $sql->bindValue(':usuario_id', $usuarioId);
        $sql->execute();
        if($sql->rowCount() > 0){
            $arrayDadosServiços = $sql->fetchAll(); //Pega todos os dados dos serviços encontrados e joga no arrayDados

            foreach($arrayDadosServiços as $dadoServico) {
                $servico = new Servico();
                $servico->setId($dadoServico['id']);
                $servico->setTitulo($dadoServico['titulo']);
                $servico->setDescricao($dadoServico['descricao']);
                $servico->setEnderecoServico($dadoServico['endereco_servico']);
                $servico->setValor($dadoServico['valor']);
                $servico->setUsuarioId($dadoServico['usuario_id']);
                $servico->setDataPostagem($dadoServico['data_postagem']);

                $arrayServicos[] = $servico;
            }
        }
        return $arrayServicos;
    }

    public function atualizar(Servico $servico){
        /**
         * Todos os dados do serviço para serem atualizados no banco de dados
         * estão no parâmetro servicos, só é preciso dar os gets nos atributos em cada bindValue
         */
        $sql = $this->pdo->prepare("UPDATE servicos SET titulo = :titulo, descricao = :descricao, endereco_servico = :endereco_servico, valor = :valor, usuario_id = :usuario_id, data_postagem = :data_postagem WHERE id = :id");
        $sql->bindValue(":id", $servico->getId());
        $sql->bindValue(":titulo", $servico->getTitulo());
        $sql->bindValue(":descricao", $servico->getDescricao());
        $sql->bindValue(":endereco_servico", $servico->getEnderecoServico());
        $sql->bindValue(":valor", $servico->getValor());
        $sql->bindValue(":usuario_id", $servico->getUsuarioId());
        $sql->bindValue(":data_postagem", $servico->getDataPostagem());
        $sql->execute();

        return true;
    }

    public function deletar($id){
        $sql = $this->pdo->prepare("DELETE FROM servicos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

}
