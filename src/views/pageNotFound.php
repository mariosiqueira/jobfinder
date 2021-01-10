<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página não encontrada</title>
    <link rel="stylesheet" href='<?php echo $routes->home.'src/views/public/app.css'?>'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body{
            background-color: lightgreen;
        }
        .container{
            width:100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color:#fff
        }
    </style>
</head>
<body>
    <div class="container">
        <img id="img_not_found" style="width: 400px" src="<?php echo $routes->home.'src/views/public/img/page_not_found.svg'?>" alt="" srcset="">
        <h1 class="mt-4">Desculpe :(</h1>
        <h2>Esta página não existe</h2>
        <div class="form-group mt-5">
            <button class="btn btn-light"
                onclick="window.location.href='<?php echo $routes->home?>'"
            >
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Página inicial
            </button>
        </div>
    </div>
</body>
</html>
