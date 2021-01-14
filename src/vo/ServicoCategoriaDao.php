<?php
namespace App\VO;

interface ServicoCategoriaDao {
    public function salvar(ServicoCategoria $servicoCategoria);
    public function buscarTodos();
    public function buscarPeloIdDoServico($servicoId);
    public function buscarPeloIdDaCategoria($categoriaId);
    public function buscarPeloNomeDaCategoria($nome);
    public function atualizar(ServicoCategoria $servicoCategoria);
    public function deletarCategoriaDeUmServico($servicoId, $categoriaId);
    public function deletar($servicoId);
}