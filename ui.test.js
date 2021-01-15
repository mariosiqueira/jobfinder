const puppeteer = require('puppeteer-core'); //npm i puppeteer-core

let launchOptions;
let browser;
let page;
var waitForLoad;

// para desabilitar o navegador, mudar a variavel headless para true;
beforeEach(async () => {
    launchOptions = {
        headless: false, executablePath: 'C:\\Program Files (x86)\\Google\\Chrome\\Application\\chrome.exe', //caminho do chrome instalado na máquina
        args: ['--start-maximized'], slowMo: 50,
    };
    browser = await puppeteer.launch(launchOptions);
    page = await browser.newPage();
    waitForLoad = async () => await new Promise(resolve => page.on('load', () => resolve())); //função pra esperar a página carregar
    await page.goto('http://localhost:8080/jobfinder');
});

afterEach(async () => {
    await browser.close();
});

// Função pra testar a interface de login
test('fazer login', async () => {

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
