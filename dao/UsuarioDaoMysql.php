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

    }

    public function buscarTodos(){
        $arrayUsuarios = [];

        $sql = $this->pdo->query("SELECT * FROM usuarios");
        if($sql->rowCount() > 0){
            $arrayDados = $sql->fetchAll(); //Pega todos os usuários e joga no arrayDados
            
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

    }

    public function atualizar(Usuario $usuario){

    }

    public function deletar($id){

    }
}