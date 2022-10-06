import DiscountIndex from '@/backend/dashboard/views/discount/Index.vue';
import DiscountCreate from '@/backend/dashboard/views/discount/partials/Create.vue';
import DiscountEdit from '@/backend/dashboard/views/discount/partials/Edit.vue';

const routes = [
  {
    name: 'discount-codes',
    path: '/dashboard/discount-codes',
    component: DiscountIndex,
  },

  {
    name: 'discount-code-create',
    path: '/dashboard/discount-code/create',
    component: DiscountCreate,
  },

  {
    name: 'discount-code-edit',
    path: '/dashboard/discount-code/edit/:id',
    component: DiscountEdit,
  },

];

export default routes;