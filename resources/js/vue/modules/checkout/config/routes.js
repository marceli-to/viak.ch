import Basket from '@/modules/checkout/pages/Basket.vue';
import User from '@/modules/checkout/pages/User.vue';
import Payment from '@/modules/checkout/pages/Payment.vue';
import Summary from '@/modules/checkout/pages/Summary.vue';
import Confirmation from '@/modules/checkout/pages/Confirmation.vue';

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
  {
    name: 'checkout-confirmation',
    path: '/checkout/confirmation',
    component: Confirmation,
  },
];

export default routes;