const vueRoutes = [
  { path: '/', name: 'home', component: HomeComponent },
  { path: '/services', name: 'services', component: JobComponent, props: route => ({ servicos: route.query.servicos }) },
  { path: '/services/show/:id', name: 'services_show', component: servicoShow, props: route => ({ servicos: route.params.id }) },
  { path: '/services/close/:id', name: 'services_close', component: servicoClose, props: route => ({ servicos: route.params.id }) },
  { path: '/messages', name: 'messages', component: MessagesComponent, props: route => ({ mensagens: route.query.mensagens, contatos: route.query.contatos }) },
  { path: '/configuration', component: ConfigComponent },
  { path: '/rating', name:'rating', component: AvaliacoesComponent, props: route => ({ avaliacoes: route.query.avaliacoes }) },
];


const router = new VueRouter({
  routes: vueRoutes
});