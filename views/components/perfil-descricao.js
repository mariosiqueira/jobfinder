var perfilDescricaoComponent = {
    props: {
        action_profile_img: {
            type: String,
            default: "http://localhost/jobfinder/controller/usuario_imagem.php"
        }
    },
    template: `
        <div class="col-lg-3 text-white" style="background-color:#343A40">
            <div class="d-flex flex-column justify-content-center align-items-center p-2 mt-3">
                <form id="change_profile_pic" :action="action_profile_img" method="post" enctype="multipart/form-data">
                    <label for="img_profile">
                        <img src="https://boostchiropractic.co.nz/wp-content/uploads/2016/09/default-user-img.jpg" alt="img profile user" id="perfil_img_user" />
                        <div id="choice-file">
                            <i class="fas fa-camera    "></i>
                        </div>
                    </label>
                    <input class="d-none" type="file" id="img_profile" v-on:change="edit_profile_file" name = "foto_perfil"/>
                </form>
                <span class="text-uppercase font-weight-bold text-center">
                    Username
                </span>
            </div>
            <p class="text-center" style="color: yellow">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </p>
            <p class="text-center mt-5">
                <strong><i>email@email.com</i></strong>
            </p>
            <p class="text-center">
                <strong><i>(87) 9 8800-0000</i></strong>
            </p>
        </div>
    `,
    methods: {
        edit_profile_file(event) {
            let op = confirm("Deseja salvar essa imagem como foto de perfil?")
            if (op) {
                $('#change_profile_pic').submit();
            }
        }
    }
}