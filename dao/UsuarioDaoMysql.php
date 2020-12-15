<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/jobfinder/vo/Usuario.php';

class UsuarioDaoMysql implements UsuarioDao {
    /**
     * O PDO vai ser passado por parâmetro no arquivo que 
     * precisar instanciar essa classe UsuarioDaoMysql.
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

    public function salvar(Usuario $usuario){
        //É melhor quebrar a query de inserção de dados, por questão de segurança. Onde tem :nome, :telefone...serão as máscaras para inserir os valores pelo bindValue
        $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:nome, :telefone, :email, :senha)");
        $sql->bindValue(":nome", $usuario->getNome());
        $sql->bindValue(":telefone", $usuario->getTelefone());
        $sql->bindValue(":email", $usuario->getEmail());
        $sql->bindValue(":senha", $usuario->getSenha());
        $sql->execute();

        $usuario->setId($this->pdo->lastInsertId());
        return $usuario;
    }

    public function buscarTodos(){
        $arrayUsuarios = [];

        $sql = $this->pdo->query("SELECT * FROM usuarios");
        if($sql->rowCount() > 0){
            $arrayDados = $sql->fetchAll(); //Pega todos os dados dos usuários encontrados e joga no arrayDados
            
            foreach($arrayDados as $dado){
                /**
                 * Deve-se construir objetos do tipo Usuario e preenchê-los com os dados 
                 * advindos do banco com a consulta para adicionar ao arrayUsuarios e retornar
                 * **/
                $usuario = new Usuario();
                $usuario->setId($dado['id']);
                $usuario->setNome($dado['nome']);
                $usuario->setTelefone($dado['telefone']);
                $usuario->setEmail($dado['email']);
                $usuario->setSenha($dado['senha']);

                $arrayUsuarios[] = $usuario; //Adiciona o usuário construído e preenchido no arrayUsuários que ao final da iteração será devolvido para quem chamou o método.
            }
        }
        return $arrayUsuarios;
    }

    public function buscarPorId($id){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if($sql->rowCount() > 0){
            $dadoUsuario = $sql->fetch(); //Pega os dados de um usuário que foi encontrado com o id passado por parâmetro e atribui à variável dadosUsuario

            /**
             * Faz o processo de construção de um objeto usuario com os dados encontrados passando o id por parâmetro
             */
            $usuario = new Usuario();
            $usuario->setId($dadoUsuario['id']);
            $usuario->setNome($dadoUsuario['nome']);
            $usuario->setTelefone($dadoUsuario['telefone']);
            $usuario->setEmail($dadoUsuario['email']);
            $usuario->setSenha($dadoUsuario['senha']);

            return $usuario;
        } else {
            return false;
        }

    }

    public function buscarPorEmail($email){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();
        if($sql->rowCount() > 0){
            $dadoUsuario = $sql->fetch(); //Pega os dados de um usuário que foi encontrado com o e-mail passado por parâmetro e atribui à variável dadosUsuario

            /**
                 * Deve-se construir um objeto do tipo Usuario e preenchê-lo com os dados 
                 * advindos do banco com a consulta para retornar à aplicação que chamou a busca por e-mail
            * **/
            $usuario = new Usuario();

            $usuario->setId($dadoUsuario['id']);
            $usuario->setNome($dadoUsuario['nome']);
            $usuario->setTelefone($dadoUsuario['telefone']);
            $usuario->setEmail($dadoUsuario['email']);
            $usuario->setSenha($dadoUsuario['senha']);

            return $usuario;

        } else {    //Se não encontrar nenhum usuário com o e-mail fornecido, retorna falso
            return false;
        }

    }

    public function atualizar(Usuario $usuario){
        /**
         * Todos os dados do usuário para serem atualizados no banco de dados 
         * estão no parâmetro usuario, só é preciso dar os gets nos atributos em cada bindValue
         */
        $sql = $this->pdo->prepare("UPDATE usuarios SET nome = :nome, telefone = :telefone, email = :email, senha = :senha WHERE id = :id");
        $sql->bindValue(":id", $usuario->getId());
        $sql->bindValue(":nome", $usuario->getNome());
        $sql->bindValue(":telefone", $usuario->getTelefone());
        $sql->bindValue(":email", $usuario->getEmail());
        $sql->bindValue(":senha", $usuario->getSenha());
        $sql->execute();

        return true;
    }

    public function deletar($id){
        $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}