import ExpertIndex from '@/modules/dashboard/views/expert/Index.vue';
import ExpertCreate from '@/modules/dashboard/views/expert/partials/Create.vue';
import ExpertEdit from '@/modules/dashboard/views/expert/partials/Edit.vue';

const routes = [
  {
    name: 'experts',
    path: '/dashboard/experts',
    component: ExpertIndex,
  },

  {
    name: 'expert-create',
    path: '/dashboard/expert/create',
    component: ExpertCreate,
  },

  {
    name: 'expert-edit',
    path: '/dashboard/expert/edit/:id',
    component: ExpertEdit,
  },

];

export default routes;