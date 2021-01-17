<?php require "layouts/front/head.php"?>
<header>
    <div class="position-absolute w-75">
        <div class="d-flex m-0 justify-content-center">
            <div class="text-center">
                <h1 class="text-white open-sans text-uppercase text-center mb-5">
                    Seja Freelancer
                </h1>
                <a class="btn btn-light btn-md text-uppercase my-5" href="<?php echo $routes->jobs;?>" id="comecar">
                    Começar
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</header>
<main class="padding-md">
    <h1 class="text-muted open-sans text-uppercase text-center">JobFinder</h1>
    <hr class="w-25 mx-auto" style="background-color: DarkSlateGray; height: 2px">
    <h5 class="text-muted text-center w-10 mx-auto my-5"><strong>JOBFINDER</strong> é uma plataforma de compartilhamento
        de serviços curtos - freelas - e contratação de profissionais para tais.<br> Faça seu <a
            href="<?php echo $routes->perfil?>">cadastro</a> e começe a usar.</h5>

    <div class="grid-details">
        <div class="grid-item">
            <i class="fas fa-lock  fa-4x text-white"></i>
            <strong class="text-white text-uppercase">
                Segurança
            </strong>
            <button class="btn show-details-item" onclick="scrollToDetail('seguranca')">
                <i class="fa fa-chevron-down text-white" aria-hidden="true"></i>
            </button>
        </div>
        <div class="grid-item">
            <i class="fas fa-user-secret fa-4x text-white"></i>
            <strong class="text-white text-uppercase">
                Sigilo
            </strong>
            <button class="btn show-details-item" onclick="scrollToDetail('sigilo')">
                <i class="fa fa-chevron-down text-white" aria-hidden="true"></i>
            </button>
        </div>
        <div class="grid-item">
            <i class="fas fa-star fa-4x text-white"></i>
            <strong class="text-white text-uppercase">
                Avaliações
            </strong>
            <button class="btn show-details-item" onclick="scrollToDetail('avaliacao')">
                <i class="fa fa-chevron-down text-white" aria-hidden="true"></i>
            </button>
        </div>
        <div class="grid-item">
            <i class="fas fa-envelope fa-4x text-white"></i>
            <strong class="text-white text-uppercase">
                Mensageria
            </strong>
            <button class="btn show-details-item" onclick="scrollToDetail('mensageria')">
                <i class="fa fa-chevron-down text-white" aria-hidden="true"></i>
            </button>
        </div>
        <div class="grid-item">
            <i class="fas fa-bell fa-4x text-white"></i>
            <strong class="text-white text-uppercase">
                Notificação
            </strong>
            <button class="btn show-details-item" onclick="scrollToDetail('notificacao')">
                <i class="fa fa-chevron-down text-white" aria-hidden="true"></i>
            </button>
        </div>
        <div class="grid-item">
            <i class="fas fa-comments-dollar fa-4x text-white"></i>
            <strong class="text-white text-uppercase">
                Negociação
            </strong>
            <button class="btn show-details-item" onclick="scrollToDetail('negociacao')">
                <i class="fa fa-chevron-down text-white" aria-hidden="true"></i>
            </button>
        </div>
    </div>

</main>
<section class="container-item-details padding-md">
    <h1 class="text-white open-sans text-uppercase text-center mt-5" style="font-size:max(2.5vw, 18pt)">Funcionalidades</h1>
    <hr class="w-25 mx-auto" style="background-color: white; height: 2px">
    <h5 class="text-white text-center w-10 mx-auto my-5">
        Veja abaixo as principais funcionalidades que o <strong>JOBFINDER</strong> oferece a você.
    </h5>
    <div class="container-item" id="seguranca">
        <img class="item-img" src="<?php echo $routes->home.'src/views/public/img/img1.svg'?>" alt="icon_seguranca">
        <p class="item-description">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus laboriosam nostrum obcaecati numquam
            perspiciatis quo quibusdam, aperiam dolorum, debitis a.
        </p>
    </div>
    <div class="container-item" id="sigilo">
        <p class="item-description">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus laboriosam nostrum obcaecati numquam
            perspiciatis quo quibusdam, aperiam dolorum, debitis a.
        </p>
        <img class="item-img" src="<?php echo $routes->home.'src/views/public/img/img2.svg'?>" alt="icon_sigilo">
    </div>
    <div class="container-item" id="avaliacao">
        <img class="item-img" src="<?php echo $routes->home.'src/views/public/img/img3.svg'?>" alt="icon_avaliacao">
        <p class="item-description">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus laboriosam nostrum obcaecati numquam
            perspiciatis quo quibusdam, aperiam dolorum, debitis a.
        </p>
    </div>
    <div class="container-item" id="mensageria">
        <p class="item-description">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus laboriosam nostrum obcaecati numquam
            perspiciatis quo quibusdam, aperiam dolorum, debitis a.
        </p>
        <img class="item-img" src="<?php echo $routes->home.'src/views/public/img/img4.svg'?>" alt="icon_mensageria">
    </div>
    <div class="container-item" id="notificacao">
        <img class="item-img" src="<?php echo $routes->home.'src/views/public/img/img5.svg'?>" alt="icon_notificacao">
        <p class="item-description">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus laboriosam nostrum obcaecati numquam
            perspiciatis quo quibusdam, aperiam dolorum, debitis a.
        </p>
    </div>
    <div class="container-item" id="negociacao">
        <p class="item-description">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus laboriosam nostrum obcaecati numquam
            perspiciatis quo quibusdam, aperiam dolorum, debitis a.
        </p>
        <img class="item-img" src="<?php echo $routes->home.'src/views/public/img/img6.svg'?>" alt="icon_negociacao">
    </div>
</section>
<footer class="footer-container px-5 pb-1 pt-1 paddind-md" id="footer">
    <div class="d-flex justify-content-around flex-wrap p-5 padding-md">
        <div class="d-flex flex-column">
            <img class="hero-footer" src="<?php echo $routes->home.'src/views/public/img/logomarca.png'?>" alt="" srcset="">
            <h1 class="text-muted text-uppercase open-sans">JobFinder</h1>
        </div>
        <div class="d-flex flex-column">
            <h5 class="text-muted open-sans text-uppercase">Nossas redes sociais</h5>
            <span class="open-sans">Nos siga, para mais informações</span>
            <p class="text-muted open-sans mt-5">
                <span>
                    <i class="fab fa-facebook" aria-hidden="true"></i>
                    Facebook
                </span><br>
                <span>
                    <i class="fab fa-instagram" aria-hidden="true"></i>
                    Instagram
                </span><br>
                <span>
                    <i class="fab fa-whatsapp" aria-hidden="true"></i>
                    Whatsapp
                </span>
            </p>
        </div>
        <div class="d-flex flex-column">
            <h5 class="text-muted text-uppercase open-sans">Endereço</h5>
            <span class="open-sans">Rua 1, Centro - Afogados da Ingazeira/PE</span>
            <p class="mt-5 open-sans">
                <a href="<?php echo $routes->login?>">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    Login
                </a><br>
                <a href="<?php echo $routes->cadastro?>">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    Cadastro
                </a><br>
                <a href="<?php echo $routes->perfil?>">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    Minha conta
                </a><br>
                <a href="<?php echo $routes->jobs?>">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    Serviços
                </a><br>
            </p>
            <p class="open-sans">
                <a href="">
                    <i class="fas fa-file-alt    "></i>
                    Termos e serviço
                </a><br>
                <a href="">
                    <i class="fas fa-file-alt    "></i>
                    Politica e privacidade
                </a>
            </p>
        </div>
    </div>
    <div class="d-flex justify-content-center m-0 mt-5">
        <p class="text-center open-sans">
            <?php echo date('Y')?> &copy; copyright todos os direitos reservados
        </p>
    </div>
</footer>
<button class="btn-top">
    <i class="fa fa-chevron-up" aria-hidden="true"></i>
</button>

<?php require "layouts/front/footer.php"?>