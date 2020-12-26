<?php 
    check_auth($routes); //faz o check se o usuario está logado
    
    $id_job = isset($_GET['s']) ? $_GET['s'] : null; //id do serviço
    if($id_job == null){ //se não for passado o id ele redeciona para a view de home, deve ser implmentado tambem para quando o id não resultar em nenhum dado do banco 
        header("location: $routes->home"); 
    }
    
    $data = (Object)[ //valores fake, deve ser substituido pelos dados vindo do bando
            "id"=>1,
            "user_id"=>1,
            "titulo"=> "servico teste",
            "descricao"=>"servico teste de teste categoria",
            "endereco"=>"afogados da ingazeira, centro, 21",
            "valor"=>"800.00",        
            "data"=>"20/10/2020"   
        ];

    $user = isset($_SESSION['auth']) ? unserialize($_SESSION['auth']) : null; //usuario autenticado na session
?>

<?php require "layouts/app/head.php"?>
<div class="container-job">
    <div class="col-md-8 m-0 p-0 mx-auto rounded" style="background-color: DarkSlateGray;">
        <div class="d-flex align-items-center justify-content-between m-0 p-3">
            <div>
                <img src="<?php echo $user->foto_perfil;?>" alt="img profile user" id="servico_img_user" />
                <span class="text-white"><?php echo $user->apelido;?></span>
            </div>
            <small class="text-white">
                <i class="fas fa-calendar"></i>
                <?php echo $data->data;?>
            </small>
        </div>
        <div class="form-group text-center">
            <h1 class="text-white">
                <?php echo "#".$data->titulo?>
            </h1>
        </div>
        <div class="my-5 p-5 paddind-md border">
            <p class="text-justify text-white font-weight-bold">
                <?php echo $data->descricao?>
            </p>
        </div>
        <p class="p-2">
            <span class="text-white">
                <i class="fas fa-map-marker-alt"></i>
                <?php echo $data->endereco?>
            </span>
            <strong class="text-white float-right">R$ <?php echo $data->valor?></strong>
        </p>
        <hr>
        <p class="w-50 d-flex flex-wrap ">
            <span v-for="i in (0,5)" class="badge badge-success m-1">
                categoria {{ i }}
            </span>
        </p>
        <hr>
    </div>
    <div class="col-md-8 mx-auto">
        <form action="urlsalvarmensagem" method="post" class="p-5 padding-md">
            <input type="hidden" name="contratante_id" value="<?php echo $data->user_id?>">
            <input type="hidden" name="contratado_id" value="<?php echo $user->id?>">
            <div class="form-row">
                <div class="col-md-12 mx-auto form-group">
                    <small class="text-muted text-uppercase">Faça sua proposta: </small>
                    <textarea class="form-control" name="mensagem" rows="3"
                        style="background-color:lightgrey">Tenho interesse no serviço</textarea>
                </div>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-outline-dark">
                    Enviar
                    <i class="fas fa-arrow-circle-right"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<?php require "layouts/app/footer.php"?>