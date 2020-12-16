<?php require "layouts/front/head.php"?>
<header>
    <div class="jf-container hero_main">
        <img id="hero_svg" src='<?php echo $routes->home."views/public/img/hero_svg.svg";?>' alt="hero svg">
        <div class="position-absolute mt-5">
            <h1 class="text-black-50 text-center mb-5">JobFinder</h1>
            <p class="w-75 mx-auto text-center">
                O <strong>JobFinder</strong> é uma plataforma de serviços freelancer, onde você pode anunciar ou até
                mesmo participar de um, faça o cadastro e comece a usar.
            </p>
            <div class="text-center m-0 mt-5">
                <button class="btn btn-success btn-md text-uppercase mb-2"
                    onclick="window.location.href='<?php echo $routes->jobs;?>'">
                    Seja Freelancer
                </button>
                <button class="btn btn-outline-primary btn-md text-uppercase mb-2"
                    onclick="window.location.href='<?php echo $routes->perfil;?>'">
                    Cadastre um Serviço
                </button>
            </div>
        </div>
    </div>
</header>
<?php require "layouts/front/footer.php"?>