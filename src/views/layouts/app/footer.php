</div>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
        <script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.9/jquery.inputmask.bundle.min.js"
            integrity="sha512-VpQwrlvKqJHKtIvpL8Zv6819FkTJyE1DoVNH0L2RLn8hUPjRjkS/bCYurZs0DX9Ybwu9oHRHdBZR9fESaq8Z8A=="
            crossorigin="anonymous"></script>
        <script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        
        <script>
            var user = <?php echo json_encode(getUser())?>;
        </script>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src='<?php echo $routes->home."src/views/components/navbar.js";?>'></script>
        <script src='<?php echo $routes->home."src/views/components/login.js";?>'></script>
        <script src='<?php echo $routes->home."src/views/components/cadastro.js";?>'></script>
        <script src='<?php echo $routes->home."src/views/components/filtro-jobs.js";?>'></script>
        <script src='<?php echo $routes->home."src/views/components/list-jobs.js";?>'></script>
        <script src='<?php echo $routes->home."src/views/components/perfil.js";?>'></script>
        <script src='<?php echo $routes->home."src/views/components/perfil-descricao.js";?>'></script>
        <script src='<?php echo $routes->home."src/views/components/perfil/home.js";?>'></script>
        <script src='<?php echo $routes->home."src/views/components/perfil/servicos.js";?>'></script>
        <script src='<?php echo $routes->home."src/views/components/perfil/mensagens.js";?>'></script>
        <script src='<?php echo $routes->home."src/views/components/perfil/configuracoes.js";?>'></script>
        <script src='<?php echo $routes->home."src/views/components/perfil/servico_show.js";?>'></script>
        <script src='<?php echo $routes->home."src/views/components/perfil/servico_close.js";?>'></script>
        <script src='<?php echo $routes->home."src/views/components/perfil/avaliacoes.js";?>'></script>
        <script src='<?php echo $routes->home."src/views/public/router.js";?>'></script>
        <script src='<?php echo $routes->home."src/views/public/app.js";?>'></script>
        <script>
            Inputmask('(99) 9 9999-9999').mask($('#telefone'))
            $('#valor').maskMoney({
                decimal: ',',
                thousands: '.'
            });
            $('#valor_job').maskMoney({
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
        <script>
            toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            }
        </script>
        <script>
            <?php if(isset($_SESSION['message'])): ?>
                toastr.<?php echo $_SESSION['message']->type ?>("<?php echo $_SESSION['message']->message ?>")
                <?php unset($_SESSION['message']); ?>
            <?php endif ?>
        </script>
        <script>
            $(document).ready(function(){
                $(".select-cat").select2({
                    closeOnSelect: false,
                    theme: 'bootstrap4',
                });
            })
        </script>
        </body>

        </html>