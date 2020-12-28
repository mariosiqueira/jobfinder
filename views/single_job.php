<?php 
    // session_start();
    // auth($routes)
    $data = [
        (Object)[
            "id"=>1,
            "titulo"=> "servico teste",
            "descricao"=>"servico teste de teste categoria",
            "endereco"=>"afogados da ingazeira, centro, 21",
            "valor"=>"800.00",           
        ]
    ];
?>

<?php require "layouts/app/head.php"?>
<div class="container-job">
    <div class="col-md-8 mx-auto border">
        <div class="d-flex align-items-center justify-content-between m-0 p-1">
            <div>
                <img src="https://boostchiropractic.co.nz/wp-content/uploads/2016/09/default-user-img.jpg"
                    alt="img profile user" id="servico_img_user" />
                <span>Usuário</span>
            </div>
            <small class="text-muted">
                <i class="fas fa-calendar"></i>    
                00/00/0000
            </small>
        </div>
        <hr>
        <div class="form-group text-center">
            <h1 class="text-muted">
                <?php echo "#".$data[0]->titulo?>
            </h1>
        </div>
        <div class="my-5 p-3 border">
            <p class="text-justify font-weight-bold">
                <?php echo $data[0]->descricao?>
            </p>
        </div>
        <p class="p-2">
            <span>
                <i class="fas fa-map-marker-alt    "></i>
                <?php echo $data[0]->endereco?>
            </span>
            <strong style="color: green; float:right">R$ <?php echo $data[0]->valor?></strong>
        </p>
    </div>
    <div class="col-md-8 mx-auto mt-3">
        <form action="" method="post">
            <input type="hidden" name="contratante_id" value="<?php echo 1?>">
            <input type="hidden" name="contratado_id" value="<?php echo 2?>">
            <div class="form-row">
                <div class="col-md-12 form-group">
                    <small class="text-muted text-uppercase">mensagem</small>
                    <textarea class="form-control" name="mensagem" rows="3"></textarea>
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-md btn-primary rounded-pill">
                        Enviar 
                        <i class="fas fa-arrow-circle-right"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require "layouts/app/footer.php"?>