import ErrorForbidden from '@/views/backend/errors/Forbidden.vue';
import ErrorNotFound from '@/views/backend/errors/NotFound.vue';

const routes = [
  // {
  //   path:'*',
  //   redirect:'/gesuche/aktuell',
  // },

  // Authorization
  {
    name: 'forbidden',
    path: '/forbidden',
    component: ErrorForbidden,
  },
  {
    name: 'not-found',
    path: '/not-found',
    component: ErrorNotFound,
  }
];

export default routes;