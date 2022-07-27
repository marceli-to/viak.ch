import DashboardIndex from '@/modules/dashboard/views/Index.vue';
import ExpertIndex from '@/modules/dashboard/views/expert/Index.vue';

const routes = [
  {
    name: '/',
    path: '/dashboard',
    component: DashboardIndex,
  },

  {
    name: 'experts',
    path: '/dashboard/experts',
    component: ExpertIndex,
  },

];

export default routes;