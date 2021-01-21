const puppeteer = require('puppeteer-core'); //npm i puppeteer-core

let launchOptions;
let browser;
let page;
var waitForLoad;

// para desabilitar o navegador, mudar a variavel headless para true;
beforeEach(async () => {
    launchOptions = {
        headless: false, executablePath: 'C:\\Program Files (x86)\\Google\\Chrome\\Application\\chrome.exe', //caminho do chrome instalado na máquina
        args: ['--start-maximized'], slowMo: 10,
        devtools: true
    };
    browser = await puppeteer.launch(launchOptions);
    page = await browser.newPage();
    waitForLoad = async () => await new Promise(resolve => page.on('load', () => resolve())); //função pra esperar a página carregar
    await page.goto('http://localhost:8080/jobfinder');
});

afterEach(async () => {
    await browser.close();
});

// função pra fazer login
async function login() {

    await page.click('#login'); //clica no botao de login no navbar da página inicial

    await waitForLoad(); //espera a página carregar

    // inserindo dados nos campos de login
    await page.type('#email', 'usuario@email.com'); //email usuário válido
    await page.type('#senha', '12345');//senha usuário válido
    await page.click('#entrar'); //clica no botão de fazer login
}

// Função pra testar a interface de login
test.skip('fazer login', async () => {

    await page.click('#login'); //clica no botao de login no navbar da página inicial

    await waitForLoad(); //espera a página carregar

    // inserindo dados nos campos de login
    await page.type('#email', 'usuario@email.com'); //email usuário válido
    await page.type('#senha', '12345');//senha usuário válido
    await page.click('#entrar'); //clica no botão de fazer login

    // se a página redirecionar para perfil é pq conseguiu logar, então a variável estado recebe true,
    // se não conseguir é pq deu erro, então a variável estado recebe false;
    var estado = page.url() == 'http://localhost:8080/jobfinder/profile' ? true : false;

    expect(estado).toBe(true); //espera que o estado seja true
}, 20000);

// testando o login com um email não cadastrado
test.skip('fazer login com email inválido', async () => {

    await page.click('#login'); //clica no botao de login no navbar da página inicial

    await waitForLoad(); //espera a página carregar

    // inserindo dados nos campos de login
    await page.type('#email', 'emailinválido@email.com'); //email usuário válido
    await page.type('#senha', '12345');//senha usuário válido
    await page.click('#entrar'); //clica no botão de fazer login

    // se a página redirecionar para perfil é pq conseguiu logar, então a variável estado recebe true,
    // se não conseguir é pq deu erro, então a variável estado recebe false;
    var estado = page.url() == 'http://localhost:8080/jobfinder/login' ? true : false;

    expect(estado).toBe(true); //espera que o estado seja true
}, 20000);

// testando a interface de cadastrar
test.skip('fazer cadastro', async () => {
    await page.click('#cadastro'); //clica no botao de cadastrar no navbar da página inicial

    await waitForLoad(); //espera a página carregar

    await page.type('#nome', 'usuario teste'); // nome usuario
    await page.type('#telefone', '00000000000'); //telefone
    await page.type('#email', 'emailvalido@email.com'); // email usuário válido
    await page.type('#senha', '12345');// senha usuário
    await page.type('#confirmSenha', '12345');// confirmar senha usuário
    
    await page.click('#btn_cadastro');//clica no botão de cadastrar

    // se a página redirecionar para perfil é pq conseguiu cadastrar, então a variável estado recebe true,
    // se não conseguir é pq deu erro, então a variável estado recebe false;
    var estado = page.url() == 'http://localhost:8080/jobfinder/profile' ? true : false;

    expect(estado).toBe(true); //espera que o estado seja true
}, 20000)

// testando o cadastro com um e-mail invalido
test.skip('fazer cadastro com email inválido', async () => {
    await page.click('#cadastro'); //clica no botao de cadastrar no navbar da página inicial

    await waitForLoad(); //espera a página carregar

    await page.type('#nome', 'usuario teste'); // nome usuario
    await page.type('#telefone', '00000000000'); //telefone
    await page.type('#email', 'usuario@email.com'); // email usuário inválido - ja está cadastrado no sistema
    await page.type('#senha', '12345');// senha usuário
    await page.type('#confirmSenha', '12345');// confirmar senha usuário
    
    await page.click('#btn_cadastro');//clica no botão de cadastrar

    // se a página redirecionar para /register é pq não conseguiu cadastrar com e-mail inválido, que é o esperado. 
    // Então a variável estado recebe true
    var estado = page.url() == 'http://localhost:8080/jobfinder/register' ? true : false;

    expect(estado).toBe(true); //espera que o estado seja true
}, 20000)

// Função pra testar a interface de editar dados usuario
test.skip('editar conta usuário', async () => {

    // fazendo login com um usuario válido
    await login();

    await waitForLoad(); //espera a página carregar

    await page.click("#perfil_configuracoes"); // clica na aba de configurações do usuario
    await page.click("#btn_editar_dados_usuario"); // clica no botão pra abrir o modal pra criar um serviço

    await page.$eval("input[name='nome']", el => el.value = ''); //delatando o texto do nome 
    await page.type("input[name='nome']", "Nome UI teste"); //insere um novo nome pro usuario
    await page.$eval("input[name='telefone']", el => el.value = ''); //delatando o texto do telefone 
    await page.type("input[name='telefone']", '00000000000'); //insere um novo telefone pro usuario
    await page.click("#btneditarConta"); //clica no botão de salvar

    // se a página redirecionar para perfil é pq conseguiu cadastrar, então a variável estado recebe true
    var estado = page.url() == 'http://localhost:8080/jobfinder/profile' ? true : false;

    expect(estado).toBe(true); //espera que o estado seja true
}, 20000);

// Função pra testar a interface de cadastrar serviço
test.skip('cadastrar serviço', async () => {

    // fazendo login com um usuario válido
    await login();

    await waitForLoad(); //espera a página carregar

    await page.click("#perfil_servicos"); // clica na aba de serviços do usuario
    await page.click("#perfil_servicos_btn_add_servico"); // clica no botão pra abrir o modal pra criar um serviço

    await page.type("input[name='titulo']", "titulo teste"); //insere um nome
    await page.type("input[name='descricao']", 'descrição teste'); //insere uma descrição
    await page.type("input[name='endereco_servico']", 'endereço teste'); //insere um endereço
    await page.type("input[name='valor']", '10000'); //digitando 1000 ele vai usar a mascara do input e transformar em 10,00

    await page.select('#categorias', 'Eletrônica'); // clica no select de categorias e seleciona a categoria Eletrônica

    await page.click("#cadastrar_servico"); //clica no botão de cadastrar

    // se a página redirecionar para perfil é pq conseguiu cadastrar, então a variável estado recebe true
    var estado = page.url() == 'http://localhost:8080/jobfinder/profile' ? true : false;

    expect(estado).toBe(true); //espera que o estado seja true
}, 20000);

// Função pra testar a interface de editar serviço
test.skip('editar serviço', async () => {

    // fazendo login com um usuario válido
    await login();

    await waitForLoad(); //espera a página carregar

    await page.click("#perfil_servicos"); // clica na aba de serviços do usuario
    await page.click("#editar4"); //clica no botão de editar do serviço 4

    // await waitForLoad(); //espera a página carregar

    await page.$eval("input[name='titulo']", el => el.value = ''); //delatando o texto do titulo 
    await page.type("input[name='titulo']", 'serviço titulo editado'); // inserindo um novo titulo para o serviço

    await page.click("#btn_editar_servico"); //clica no botão de salvar a alteração

    // se a página redirecionar para perfil é pq conseguiu cadastrar, então a variável estado recebe true
    var estado = page.url() == 'http://localhost:8080/jobfinder/profile' ? true : false;

    expect(estado).toBe(true); //espera que o estado seja true
}, 20000);

// Função pra testar a interface de deletar um serviço
test.skip('deletar serviço', async () => {

    // fazendo login com um usuario válido
    await login();

    await waitForLoad(); //espera a página carregar

    await page.click("#perfil_servicos"); // clica na aba de serviços do usuario

    await page.on("dialog", (dialog) => { //função pra escultar o evento de dialog - javascript confirm
        console.log(dialog.message()); //mostra a mensagem do dialog
        dialog.accept(); //clica no 'ok' pra confirmar a exclusão do serviço
    });
    await page.click("#deletar4"); //clica no botão de deletar o serviço 4, gerando um dialog


    // se a página redirecionar para perfil é pq conseguiu cadastrar, então a variável estado recebe true
    var estado = page.url() == 'http://localhost:8080/jobfinder/profile' ? true : false;

    expect(estado).toBe(true); //espera que o estado seja true
}, 20000);

// Função pra testar a interface de serviços
test.skip('lista de serviços', async () => {

    await page.click("#comecar"); // clica na aba de serviços do usuario

    await waitForLoad(); //espera a página carregar

    await page.click("#proposta5"); // clica em fazer proposta no serviço de id 5

    // se a página redirecionar para login é pq o usuario da sessão não fez login, então a variável estado recebe true
    var estado = page.url() == 'http://localhost:8080/jobfinder/login' ? true : false;

    expect(estado).toBe(true); //espera que o estado seja true
}, 20000);

// Função pra testar a interface filtro de serviços - pra fazer o teste é necessário estar em dispositivos com tela md
test.skip('filtro de serviços', async () => {

    await page.click("#comecar"); // clica na aba de serviços do usuario

    await waitForLoad(); //espera a página carregar

    await page.type("input[name='descricao']", 'teste pesquisa'); // inserindo uma descrição pra filtrar
    await page.select("select[name='categoria']", '1'); // selecionando a categoria Eletrônica pra filtrar

    await page.click("#btn_filtrar_jobs"); //clica no botão de filtrar


    // se a página redirecionar para jobs, com as query's de descricao e categoria é pq o filtro foi aplicado, 
    // então a variável estado recebe true
    var estado = page.url() == 'http://localhost:8080/jobfinder/jobs?descricao=teste+pesquisa&categoria=1' ? true : false;

    expect(estado).toBe(true); //espera que o estado seja true
}, 20000);

// Função pra testar a interface de proposta dos serviços
test.skip('proposta serviços', async () => {

    await login(); //faz login com um usuario válido

    await waitForLoad(); //espera carregar a página

    await page.click(".navbar-brand"); // clica no link pra voltar para a tela de welcome

    await waitForLoad(); //espera carregar a página

    await page.click("#comecar"); // clica na link para ver os serviços disponíveis

    await waitForLoad(); //espera a página carregar

    await page.click("#proposta5"); // clica em um serviço - o escolhido para o teste foi o de id 5

    await waitForLoad(); //espera a página carregar

    // inserindo a proposta para o dono do serviço
    await page.$eval("textarea[name='mensagem']", el => el.value=""); //remove a mensagem padrão
    await page.type("textarea[name='mensagem']", 'Olá amigo, tenho interesse em fazer o serviço.'); //insere uma nova

    await page.click("#btn_enviar_proposta"); //clica no botão de enviar

    // se a página redirecionar para jobs então a variável estado recebe true
    var estado = page.url() == 'http://localhost:8080/jobfinder/jobs' ? true : false;

    expect(estado).toBe(true); //espera que o estado seja true
}, 20000);








