var perfilDescricaoComponent = {
    props: {
        ation_profile_img: {
            type: String,
            required: true
        },
        avaliacao_usuario: { //aqui deve vir do banco a media das avaliações deste usuário
            required: true
        },
        url:{
            required:true
        }
    },
    data(){
        return{
            usuario: user, //dado vem da session do usuario logado, variável está no footer do layout app
            ava_usuario: parseInt(this.avaliacao_usuario), //criando uma nova variavel para converter o valor padrao para inteiro
            foto: this.url +"files/"+user.fotoPerfil
        }
    },
    template: `
        <div class="col-lg-3 text-white" style="background-color:#343A40">
            <div class="d-flex flex-column justify-content-center align-items-center p-2 mt-3">
                <form id="change_profile_pic" :action="ation_profile_img" method="post" enctype="multipart/form-data">
                    <label for="img_profile">
                        <img :src="foto" alt="img profile user" id="perfil_img_user" />
                        <div id="choice-file">
                            <i class="fas fa-camera"></i>
                        </div>
                    </label>
                    <input class="d-none" type="file" id="img_profile" v-on:change="edit_profile_file" name="foto_perfil">
                </form>
                <span class="text-uppercase font-weight-bold text-center">
                    {{usuario.apelido}}
                </span>
            </div>
            <p class="text-center">
                <i class="fas fa-star" v-for="i in (0, 5)" :class="i < ava_usuario ? ' text-warning' : ' text-muted'"></i>
            </p>
            <p class="text-center mt-5">
                <strong><i>{{usuario.email}}</i></strong>
            </p>
            <p class="text-center">
                <strong><i>{{usuario.telefone}}</i></strong>
            </p>
        </div>
    `,
    methods: {
        edit_profile_file() {
            let op = confirm("Deseja salvar essa imagem como foto de perfil?")
            if (op) {
                $('#change_profile_pic').submit();
            }
        }
    }
}