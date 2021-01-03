<?php
class Mensagem{
    private $id;
    private $contratante_id;
    private $contratado_id;
    private $mensagem;

    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $this->id = trim($id);
    }

    public function getContratanteId(){
        return $this->contratante_id;
    }
    
    public function setContratanteId($id){
        $this->contratante_id = $id;
    }

    public function getContratadoId(){
        return $this->contratado_id;
    }
    
    public function setContratadoId($id){
        $this->contratado_id = $id;
    }
    
    public function getMensagem(){
        return $this->mensagem;
    }

    public function setMensagem($mensagem){
        $this->mensagem = $mensagem;
    }
}

interface MensagemDao {
    public function salvar(Mensagem $categoria);
    // public function buscarTodas();
    // public function buscarPeloId($id);
    // public function buscarPeloNome($nome);
    // public function atualizar(Mensagem $categoria);
    // public function deletar($id);
}