<?php
    $data = [
        [
            "id"=>1,
            "titulo"=> "servico teste",
            "descricao"=>"servico teste de teste categoria",
            "endereco"=>"afogados da ingazeira, centro, 21",
            "valor"=>"800.00",           
        ],
        [
            "id"=>2,
            "titulo"=> "servico teste",
            "descricao"=>"servico teste de teste categoria",
            "endereco"=>"afogados da ingazeira, centro, 21",
            "valor"=>"800.00",           
        ],
        [
            "id"=>3,
            "titulo"=> "servico teste",
            "descricao"=>"servico teste de teste categoria",
            "endereco"=>"afogados da ingazeira, centro, 21",
            "valor"=>"800.00",           
        ],
        [
            "id"=>4,
            "titulo"=> "servico teste",
            "descricao"=>"servico teste de teste categoria",
            "endereco"=>"afogados da ingazeira, centro, 21",
            "valor"=>"800.00",           
        ],
        [
            "id"=>5,
            "titulo"=> "servico teste",
            "descricao"=>"servico teste de teste categoria",
            "endereco"=>"afogados da ingazeira, centro, 21",
            "valor"=>"800.00",           
        ],
        [
            "id"=>6,
            "titulo"=> "servico teste",
            "descricao"=>"servico teste de teste categoria",
            "endereco"=>"afogados da ingazeira, centro, 21",
            "valor"=>"800.00",           
        ],
    ];

?>

<?php require "layouts/app/head.php"?>
<div class="container-job">
    <h2 class="text-black-50 text-center text-uppercase mb-5" style="font-size: max(2.5vw, 12pt)">
        Encontre o <u><strong>JOB</strong></u> ideal para você
    </h2>
    <div class="d-flex">
        <input type="checkbox" checked class="d-none" id="close_navbar" />
        <label for="close_navbar" class="cursor_pointer">
            <i class="fas fa-bars fa-2x ml-2"></i>
        </label>

        <filtro-jobs-component></filtro-jobs-component>
        <list-jobs-component servicos='<?php echo json_encode($data);?>' show_job="<?php echo $routes->jobs_show?>">
            <list-jobs-component>
    </div>
</div>
<?php require "layouts/app/footer.php"?>