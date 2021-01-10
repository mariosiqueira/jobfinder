const vueRoutes = [
  { path: '/', name: 'home', component: HomeComponent },
  { path: '/services', name: 'services', component: JobComponent, props: route => ({ servicos: route.query.servicos, homeurl: route.query.homeurl, contatos: route.query.contatos  }) },
  { path: '/services/show', name: 'services_show', component: servicoShow, props: route => ({ servico: route.query.servico }) },
  { path: '/services/close/:id', name: 'services_close', component: servicoClose, props: route => ({ servicos: route.params.id, homeurl: route.query.homeurl, contatos: route.query.contatos }) },
  { path: '/messages', name: 'messages', component: MessagesComponent, props: route => ({ mensagens: route.query.mensagens, contatos: route.query.contatos, homeurl: route.query.homeurl }) },
  { path: '/configuration', component: ConfigComponent },
  { path: '/rating', name:'rating', component: AvaliacoesComponent, props: route => ({ avaliacoes: route.query.avaliacoes, homeurl: route.query.homeurl }) },
];


const router = new VueRouter({
  routes: vueRoutes
});