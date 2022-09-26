import Basket from '@/modules/frontend/checkout/views/Overview.vue';
import User from '@/modules/frontend/checkout/views/User.vue';
import Payment from '@/modules/frontend/checkout/views/Payment.vue';
import Summary from '@/modules/frontend/checkout/views/Summary.vue';

const routes = [
  {
    name: 'checkout-basket',
    path: '/checkout/basket',
    component: Basket,
  },
  {
    name: 'checkout-user',
    path: '/checkout/user',
    component: User,
  },
  {
    name: 'checkout-payment',
    path: '/checkout/payment',
    component: Payment,
  },
  {
    name: 'checkout-summary',
    path: '/checkout/summary',
    component: Summary,
  },
];

export default routes;