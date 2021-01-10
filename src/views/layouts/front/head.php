<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOBFINDER</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href='<?php echo $routes->home."src/views/public/app.css";?>'>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top" id="navbar">
        <a class="navbar-brand" href="<?php echo $routes->home;?>">
            <img id="logomarca" src="<?php echo $routes->home."src/views/public/img/logomarca.png";?>" alt="logomarca" />
            <strong>JobFinder</strong>
        </a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav ml-auto mr-5 mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link text-uppercase font-weight-bold border-hover" style="cursor:pointer" onclick="scrollToDetail('footer')">Sobre nós
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item active mr-5">
                    <a class="nav-link text-uppercase font-weight-bold border-hover"
                        href="<?php echo $routes->jobs;?>">JOB's</a>
                        <span class="sr-only">(current)</span></a>

                </li>
                <a href="<?php echo $routes->cadastro?>" id="cadastro" class="btn btn-outline-light ml-2 mb-2">Cadastre-se</a>
                <a href="<?php echo $routes->login?>" class="btn ml-2 mb-2" style="background-color:DarkSlateGray; color:#fff">Login</a>
            </ul>
        </div>
    </nav>