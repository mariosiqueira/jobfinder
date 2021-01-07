<?php
class UsuarioServico implements JsonSerializable{
    private $id;
    private $dataFinalizacaoServico;
    private $valorFinal;
    private $metodoPagamento;
    private $servicoId;
    private $contratanteId;
    private $contratadoId;

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'dataFinalizacaoServico' => $this->dataFinalizacaoServico,
            'metodoPagamento' => $this->metodoPagamento,
            'valorFinal' => $this->valorFinal,
            'servicoId' => $this->servicoId,
            'contratanteId' => $this->contratanteId,
            'contratadoId' => $this->contratadoId,
        ];
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = trim($id);
    }

    public function getDataFinalizacaoServico(){
        return $this->dataFinalizacaoServico;
    }

    public function setDataFinalizacaoServico($dataFinalizacaoServico){
        $this->dataFinalizacaoServico = trim($dataFinalizacaoServico);
    }

    public function getMetodoPagamento(){
        return $this->metodoPagamento;
    }

    public function setMetodoPagamento($metodoPagamento){
        $this->metodoPagamento = trim($metodoPagamento);
    }

    public function getValorFinal(){
        return $this->valorFinal;
    }

    public function setValorFinal($valorFinal){
        $this->valorFinal = $valorFinal;
    }

    public function getServicoId(){
        return $this->servicoId;
    }

    public function setServicoId($servicoId){
        $this->servicoId = $servicoId;
    }

    public function getContratanteId(){
        return $this->contratanteId;
    }

    public function setContratanteId($contratanteId){
        $this->contratanteId = $contratanteId;
    }

    public function getContratadoId(){
        return $this->contratadoId;
    }

    public function setContratadoId($contratadoId){
        $this->contratadoId = $contratadoId;
    }
}

interface UsuarioServicoDao {
    public function salvar(UsuarioServico $usuarioServico);
    public function buscarTodos();
    public function buscarPeloId($id);
    public function buscarPeloContratanteId($contratanteId);
    public function buscarPeloContratadoId($contratadoId);
    public function atualizar(UsuarioServico $usuarioServico);
    public function deletar($id);
    public function deletarPeloServicoId($servicoId);
}
