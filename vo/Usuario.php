<?php
class Usuario {
    private $id;
    private $nome;
    private $telefone;
    private $email;
    private $senha;

    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $this->id = trim($id);
    }
    
    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = ucwords(trim($nome));
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function setTelefone($telefone){
        $this->telefone = trim($telefone);
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = strtolower(trim($email));
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($senha){
        $this->senha = trim($senha);
    }
}

interface UsuarioDao {
    public function salvar(Usuario $usuario);
    public function buscarTodos();
    public function buscarPorId($id);
    public function buscarPorEmail($email);
    public function atualizar(Usuario $usuario);
    public function deletar($id);
}