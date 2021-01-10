<?php
namespace App\VO;

interface MensagemDao {
    public function salvar(Mensagem $categoria);
    // public function buscarTodas();
    // public function buscarPeloId($id);
    // public function buscarPeloNome($nome);
    // public function atualizar(Mensagem $categoria);
    public function buscarMensagens($id);
    public function deletarMensagemPeloContratanteId($id);
    public function deletarMensagemPeloContratadoId($id);
}