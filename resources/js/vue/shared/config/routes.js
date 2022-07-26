import ErrorForbidden from '@/shared/views/errors/Forbidden.vue';
import ErrorNotFound from '@/shared/views/errors/NotFound.vue';

const routes = [

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