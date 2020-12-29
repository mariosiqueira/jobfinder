</div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
        <script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.9/jquery.inputmask.bundle.min.js"
            integrity="sha512-VpQwrlvKqJHKtIvpL8Zv6819FkTJyE1DoVNH0L2RLn8hUPjRjkS/bCYurZs0DX9Ybwu9oHRHdBZR9fESaq8Z8A=="
            crossorigin="anonymous"></script>
        <script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>
        <script>
            var user = <?php echo isset($_SESSION['auth']) ? json_encode(unserialize($_SESSION['auth'])): "{apelido: null}";?>;
        </script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src='<?php echo $routes->home."views/components/navbar.js";?>'></script>
        <script src='<?php echo $routes->home."views/components/login.js";?>'></script>
        <script src='<?php echo $routes->home."views/components/cadastro.js";?>'></script>
        <script src='<?php echo $routes->home."views/components/filtro-jobs.js";?>'></script>
        <script src='<?php echo $routes->home."views/components/list-jobs.js";?>'></script>
        <script src='<?php echo $routes->home."views/components/perfil.js";?>'></script>
        <script src='<?php echo $routes->home."views/components/perfil-descricao.js";?>'></script>
        <script src='<?php echo $routes->home."views/components/perfil/home.js";?>'></script>
        <script src='<?php echo $routes->home."views/components/perfil/servicos.js";?>'></script>
        <script src='<?php echo $routes->home."views/components/perfil/mensagens.js";?>'></script>
        <script src='<?php echo $routes->home."views/components/perfil/configuracoes.js";?>'></script>
        <script src='<?php echo $routes->home."views/components/perfil/servico_show.js";?>'></script>
        <script src='<?php echo $routes->home."views/components/perfil/servico_close.js";?>'></script>
        <script src='<?php echo $routes->home."views/public/router.js";?>'></script>
        <script src='<?php echo $routes->home."views/public/app.js";?>'></script>
        <script>
            Inputmask('(99) 9 9999-9999').mask($('#telefone'))
            $('#valor').maskMoney({
                decimal: ',',
                thousands: '.'
            });
            $(document).ready(function() {
                $("#btnDeletarConta").attr('disabled', true)
                
                $("#inputDeletarConta").on('keyup', function(e) {
                    var value = $("#inputDeletarConta").val();
                    if(value == ""){
                        $("#btnDeletarConta").attr('disabled', true)
                    } else {
                        $("#btnDeletarConta").attr('disabled', false)
                    }
                })
            })
        </script>
        </body>

        </html>