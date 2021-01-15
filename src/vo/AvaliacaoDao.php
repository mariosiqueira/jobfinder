<?php
namespace App\VO;

interface AvaliacaoDao {
    public function salvar(Avaliacao $avaliacao);
    public function buscarAvaliacoesUsuario($id);
}