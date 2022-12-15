import Basket from '@/frontend/checkout/views/Overview.vue';
import User from '@/frontend/checkout/views/User.vue';
import Payment from '@/frontend/checkout/views/Payment.vue';
import Summary from '@/frontend/checkout/views/Summary.vue';

const routes = [
  {
    name: 'de-checkout-basket',
    path: '/de/checkout/basket',
    component: Basket,
  },
  {
    name: 'en-checkout-basket',
    path: '/en/checkout/basket',
    component: Basket,
  },
  {
    name: 'de-checkout-user',
    path: '/de/checkout/address',
    component: User,
  },
  {
    name: 'en-checkout-user',
    path: '/en/checkout/address',
    component: User,
  },
  {
    name: 'de-checkout-payment',
    path: '/de/checkout/payment',
    component: Payment,
  },
  {
    name: 'en-checkout-payment',
    path: '/en/checkout/payment',
    component: Payment,
  },

  {
    name: 'de-checkout-summary',
    path: '/de/checkout/summary',
    component: Summary,
  },
  {
    name: 'en-checkout-summary',
    path: '/en/checkout/summary',
    component: Summary,
  },
];

export default routes;