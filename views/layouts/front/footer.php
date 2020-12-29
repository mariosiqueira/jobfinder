<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        <script>
            window.onscroll = function (params) {
                if (scrollY >= 10) {
                    document.getElementById('navbar').className =
                        'navbar navbar-expand-md navbar-light bg-light shadow fixed-top';
                    document.querySelector('#cadastro').className = 'btn btn-outline-primary ml-2 mb-2';
                } else {
                    document.getElementById('navbar').className = 'navbar navbar-expand-md navbar-dark fixed-top';
                    document.querySelector('#cadastro').className = 'btn btn-outline-light ml-2 mb-2';
                }
                if (scrollY >= 100) {
                    document.querySelector('.btn-top').style.display = 'flex'
                } else {
                    document.querySelector('.btn-top').style.display = 'none'
                }
            }
        </script>
        <script>
            function scrollToDetail(id) {
                document.querySelector(`#${id}`).scrollIntoView({
                    behavior: 'smooth',
                    block: "center",
                    inline: "center"
                });
            }
            $('.btn-top').on('click', function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });

            })
        </script>
        </body>

        </html>