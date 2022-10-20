import HeroIndex from '@/backend/dashboard/views/hero/Index.vue';
import HeroCreate from '@/backend/dashboard/views/hero/partials/Create.vue';
import HeroEdit from '@/backend/dashboard/views/hero/partials/Edit.vue';

const routes = [
  {
    name: 'content-heroes',
    path: '/dashboard/heroes',
    component: HeroIndex,
  },
  {
    name: 'content-hero-create',
    path: '/dashboard/hero/create',
    component: HeroCreate,
  },
  {
    name: 'content-hero-edit',
    path: '/dashboard/hero/edit/:id',
    component: HeroEdit,
  },
];

export default routes;