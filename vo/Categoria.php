<?php
class Categoria{
    private $id;
    private $nome;

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
}

interface CategoriaDao {
    public function salvar(Categoria $categoria);
    public function buscarTodas();
    public function buscarPeloId($id);
    public function buscarPeloNome($nome);
    public function atualizar(Categoria $categoria);
    public function deletar($id);
}