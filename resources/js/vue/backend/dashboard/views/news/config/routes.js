import NewsIndex from '@/backend/dashboard/views/news/Index.vue';
import NewsCreate from '@/backend/dashboard/views/news/partials/Create.vue';
import NewsEdit from '@/backend/dashboard/views/news/partials/Edit.vue';

const routes = [
  {
    name: 'content-news',
    path: '/dashboard/news',
    component: NewsIndex,
  },
  {
    name: 'content-news-create',
    path: '/dashboard/news/create',
    component: NewsCreate,
  },
  {
    name: 'content-news-edit',
    path: '/dashboard/news/edit/:id',
    component: NewsEdit,
  },
];

export default routes;