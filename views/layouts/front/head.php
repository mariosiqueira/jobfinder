<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOBFINDER</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href='<?php echo $routes->home."views/public/app.css";?>'>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-success fixed-top" id="navbar" style="background-color:green">
        <a class="navbar-brand" href="<?php echo $routes->home;?>">
            <img id="logomarca" src="<?php echo $routes->home."views/public/img/logomarca.png";?>" alt="logomarca" />
            <strong>JobFinder</strong>
        </a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav ml-auto mr-5 mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link text-uppercase font-weight-bold" href="<?php echo $routes->perfil;?>">Cadastre um JOB <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-uppercase font-weight-bold" href="<?php echo $routes->jobs;?>">Pesquise por um JOB</a>
                </li>
            </ul>
        </div>
    </nav>
    