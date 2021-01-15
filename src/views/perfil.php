<?php
    check_auth($routes); //faz o check se o usuario está logado
?>

<?php 
    require "layouts/app/head.php";

    use App\Config\Conexao;//Importa o PDO
    use App\VO\Categoria;
    use App\VO\Servico;

    use App\Dao\UsuarioDaoMysql; 
    use App\Dao\ServicoCategoriaDaoMysql; 

    use App\Dao\CategoriaDaoMysql; //import da classe CategoriaDaoMysql pra buscar as categorias do banco de dados e mostrar na aplicação na hora de criar um novo serviço
    use App\Dao\ServicoDaoMysql; //Import da classe ServicoDaoMysql para recuperar os serviços cadastrados pelo usuário da sessão e que serão exibidos no perfil dele
    use App\Dao\MensagemDaoMysql; //Import da classe MensagemDaoMysql para recuperar as mensagens cadastrados pelo usuário da sessão e que serão exibidos no perfil dele
    use App\Dao\AvaliacaoDaoMysql; //Import da classe AvaliacaoDaoMysql para recuperar as avaliaçoes recebidas pelo usuário da sessão e que serão exibidos no perfil dele

    $pdo = Conexao::getInstance();

    //Recuperando as categorias cadastradas no banco de dados para exibir no modal de cadastro de serviço
    $categoriaDao = new CategoriaDaoMysql($pdo);
    $categorias = [];
    $arrayDadosObjetosCategorias = $categoriaDao->buscarTodas();
    foreach($arrayDadosObjetosCategorias as $dadoObjetoCategoria) {
        $novaCategoria = new Categoria();
        $novaCategoria->setId($dadoObjetoCategoria->getId());
        $novaCategoria->setNome($dadoObjetoCategoria->getNome());
        $categorias [] = $novaCategoria;
    }

    //Recuperando os serviços cadastrados pelo usuário da sessão
    $usuarioSessao = unserialize($_SESSION['auth']);
    $servicoDao = new ServicoDaoMysql($pdo);
    $servicos = [];

    $usuarioDao = new UsuarioDaoMysql($pdo);
    $servicoCategoria = new ServicoCategoriaDaoMysql($pdo);

    $arrayDadosObjetosServico = $servicoDao->buscarServicoPeloIdDoUsuario($usuarioSessao->getId());
    if($arrayDadosObjetosServico != null) {
        
        foreach($arrayDadosObjetosServico as $dadoObjetoServico) {
            $novoServico = new Servico();
            $novoServico->setId($dadoObjetoServico->getId());
            $novoServico->setTitulo($dadoObjetoServico->getTitulo());
            $novoServico->setDescricao($dadoObjetoServico->getDescricao());
            $novoServico->setEnderecoServico($dadoObjetoServico->getEnderecoServico());
            $novoServico->setValor($dadoObjetoServico->getValor());
            $novoServico->setUsuarioId($dadoObjetoServico->getUsuarioId());
            $novoServico->setDataPostagem($dadoObjetoServico->getDataPostagem());
            $novoServico->setStatus($dadoObjetoServico->getStatus());
            // $servicos [] = $novoServico;
            $servicos [] = array(
                'servico' => $novoServico,
                'categorias' => $servicoCategoria->buscarCategoriasDoServico($novoServico->getId())
            );
        }
    }

    //Recuperando as mensagens enviadas ou recebidas pelo usuário da sessão
    $mensagenDao = new MensagemDaoMysql($pdo);
    $dataMensagens = $mensagenDao->buscarMensagens(getUser()->getId());

    $mensagens = [];
    $contatos = [];

    if ($dataMensagens) {
        
        foreach($dataMensagens as $m) {
            
            // pega todas as mesagens enviadas ou recebidas do usuario logado, e armazena em mensagens
            $mensagens[] = [ 
                "id" => $m['id'],
                "contratante_id" => $m['contratante_id'],
                "contratado_id" => $m['contratado_id'],
                "mensagem" => $m['mensagem'],
            ]; 

            //pega os usuários que enviaram ou recebream mensagens do usuário logado, e armazena em contatos
            if (!array_key_exists($m['contratado_id'], $contatos) && $m['contratado_id'] != getUser()->getId()) {

                $contatos[$m['contratado_id']] = $usuarioDao->buscarPeloId($m['contratado_id']);
            }
            if (!array_key_exists($m['contratante_id'], $contatos) && $m['contratante_id'] != getUser()->getId()) {

                $contatos[$m['contratante_id']] = $usuarioDao->buscarPeloId($m['contratante_id']);
            }
        }
        
    }

    //Recuperando as avaliaçoes recebidas pelo usuário da sessão
    $avaliacaoDao = new AvaliacaoDaoMysql($pdo);
    $dataAvaliacao = $avaliacaoDao->buscarAvaliacoesUsuario(getUser()->getId());

    $avaliacoes = [];
    $somaAvaliacoes = 0; //variavel pra pegar a soma de todas as avaliações deste usuario

    $index = 0; //quantidade de avaliações recebidas
    if ($dataAvaliacao) {
        foreach($dataAvaliacao as $ava) {
            $aux = [];
            $aux['id'] = $ava['id'];
            $aux['avaliacao'] = $ava['avaliacao'];
            $aux['comentario'] = $ava['comentario'];
            $aux['usuario_id'] = $ava['usuario_id'];
            $aux['avaliador_id'] = $usuarioDao->buscarPeloId($ava['avaliador_id']);
        
            $avaliacoes[] = $aux;
        
            $somaAvaliacoes += intval($ava['avaliacao']); //somando todas as avaliações
            $index++;
        }
    }

    $mediaAvaliacoes = $index == 0 ? $somaAvaliacoes : round($somaAvaliacoes / $index); //media de avaliações do usuario logado
?>

<div class="row m-0 container-perfil">
    <perfil-descricao-component ation_profile_img="<?= $routes->alterar_imagem; ?> "
        avaliacao_usuario="<?php echo $mediaAvaliacoes?>" url='<?php echo $routes->home;?>'>
    </perfil-descricao-component>
    <perfil-component homeurl='<?php echo $routes->home;?>' servicos='<?php echo json_encode($servicos);?>'
        categorias='<?php echo json_encode($categorias);?>'
        mensagens='<?php echo json_encode($mensagens);?>' contatos='<?php echo json_encode($contatos);?>'
        avaliacoes='<?php echo json_encode($avaliacoes);?>'>
    </perfil-component>
</div>
<!-- Modal alterar apelido -->
<div class="modal fade" id="alterar_apelido" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo $routes->alterar_apelido ;?>" method="post">
                    <div class="col-md-12 form-group">
                        <label for="apelido" class="required">Apelido</label>
                        <input type="text" name="apelido" id="apelido" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-md btn-block rounded-pill">
                            Alterar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal termos e responsabilidade -->
<div class="modal fade" id="termos_e_responsabilidade" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="text-muted text-uppercase text-center mb-4">Termos e resonsabilidade</h3>
                <div class="col-md-6 mx-auto form-group text-center">
                    <p class="text-justify">
                        Eu, estou de acordo com os seguintes termos:

                        1 - Dos dados pessoais deverão ser obedecidas as seguintes regras:

                        1.1 - Permito que meus dados pessoais sejam utilizados para fins de cadastro na plataforma Job
                        Finder;

                        1.2 - Quanto a foto do perfil:

                        1.2.1 - Não é permitido pornografia em geral(nudez, pedofilia, zoofilia, etc.) ou conteúdo
                        violento (gore, nazismo, apologia ao radicalismo e etc.);

                        1.2.2 - Não é permitido fotos com terceiros selecione uma que esteja apenas você mesmo;

                        1.2.3 - Não é permitido fotos com personagens ficticios (personagens de desenho, animes, games e
                        etc.) ou reais tais como famosos em geral;

                        1.3 - Não serão permitidas contas criadas por menores de idade, sendo a idade mínima 18 anos.

                        2 - Todas as informações obrigatórias serão fornecidas para que seja realizado o meu cadastro;

                        3 - Se necessário for, permito que meu perfil ou ações feitas pelo mesmo sejam usados para fins
                        de marketing empresarial da plataforma em questão;

                        4 - Caso queira encerrar minha conta meu perfil estará disponível caso eu deseje uma possível
                        volta:

                        4.1 - Nesse caso estarão salvos os dados antes da conta ser encerrada;

                        5 - Caso queira me candidatar a uma vaga meu perfil estará disponível para conversa da parte
                        interessado;

                        6 - Quanto a conduta de comportamento:

                        6.1 - Estou ciente que serei expulso caso não respeite os demais usuários e administradores da
                        plataforma;

                        6.2 - Poderei sofrer penas legais caso falte com respeito com os demais integrante tal como dito
                        anteriormente.

                    </p>
                    <p class="text-right">
                        <strong>JOBFINDER</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal adicionar servico -->
<div class="modal fade" id="adicionar_servico" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo $routes->create_job?>" method="post">
                    <div class="form-row">
                        <div class="col-md-12 form-group">
                            <label for="" class="required">Titulo</label>
                            <input type="text" class="form-control" name="titulo" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="required">Descricao</label>
                            <input type="text" class="form-control" name="descricao" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">Endereço</label>
                            <input type="text" class="form-control" name="endereco_servico">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="valor">Valor</label>
                            <input type="text" class="form-control" id="valor" name="valor">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="categorias" class="required">Categoria</label>
                            <select multiple class="form-control" name="categoria[]" id="categorias" required>
                                <?php foreach($categorias as $categoria):?>
                                <option><?php echo $categoria->getNome()?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <button class="btn btn-success btn-md btn-block rounded-pill">
                            Cadastrar
                        </button>
                    </div>
                    <input type="hidden" name="usuario_id" value=<?= $usuarioSessao->getId() ?>>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal deletar conta -->
<div class="modal fade" id="deletar_conta" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="text-muted text-uppercase text-center">Deseja realmente deletar sua conta?</h4>
                <form action="<?= $routes->deletar_conta; ?>" method="post" id="deletarConta">
                    <div class="form-group mt">
                        <span class="badge badge-danger p-2 mt-5 mb-2">Para deletar sua conta, você precisa confirmar
                            sua senha</span>
                        <input type="password" class="form-control shadow-none" name="senha" placeholder="Senha"
                            id="inputDeletarConta" required />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary shadow-none" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger shadow-none" id="btnDeletarConta"
                    onclick="$('#deletarConta').submit()">Deletar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal editar dados conta -->
<div class="modal fade" id="editar_conta" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= $routes->editar_conta ;?>" method="post" id="editarConta">
                    <input type="hidden" name="user_id">
                    <div class="cold-md-12 form-group">
                        <label for="nome" class="required">Nome</label>
                        <input type="text" class="form-control shadow-none" name="nome"
                            value="<?php echo getUser()->getNome()?>" required />
                    </div>
                    <div class="cold-md-12 form-group">
                        <label for="telefone" class="required">Telefone</label>
                        <input type="text" class="form-control shadow-none" id="telefone" name="telefone"
                            value="<?php echo getUser()->getTelefone()?>" required />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary shadow-none" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary shadow-none" id="btneditarConta"
                    onclick="$('#editarConta').submit()">Salvar</button>
            </div>
        </div>
    </div>
</div>

<?php require "layouts/app/footer.php"?>