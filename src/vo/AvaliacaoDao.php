<?php
namespace App\VO;
use JsonSerializable;

interface AvaliacaoDao {
    public function salvar(Avaliacao $avaliacao);
    public function buscarAvaliacoesUsuario($id);
}