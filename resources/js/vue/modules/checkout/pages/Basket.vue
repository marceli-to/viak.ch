<template>
  <div v-if="isLoaded">
    <template v-if="events.length > 0">

      <checkout-header>
        <template #title>
          {{ __('Bestellübersicht') }}
        </template>
        <template #step>
          {{ __('Schritt') }} 1/4
        </template>
      </checkout-header>

      <checkout-card v-for="event in events" :key="event.uuid" :event="event">
        <a href="" class="btn-secondary btn-auto-w" @click.prevent="remove(event.uuid)">
          {{ __('Entfernen') }}
        </a>
      </checkout-card>

      <checkout-footer>
        <router-link :to="{ name: 'checkout-user' }" class="btn-next btn-next-wide span-12">
          <span>{{ __('Weiter') }}</span>
          <icon-arrow-right />
        </router-link>
      </checkout-footer>

    </template>

    <template v-else>
      <div class="checkout__basket-empty">
        {{ __('Dein Warenkorb ist leer...') }}
      </div>
    </template>
  </div>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import BasketCounter from "@/shared/mixins/BasketCounter";
import i18n from "@/shared/mixins/i18n";
import CheckoutCard from "@/modules/checkout/components/Card.vue";
import CheckoutHeader from "@/modules/checkout/components/Header.vue";
import CheckoutFooter from "@/modules/checkout/components/Footer.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";

export default {

  components: {
    NProgress,
    CheckoutCard,
    CheckoutHeader,
    CheckoutFooter,
    IconArrowRight
  },

  mixins: [ErrorHandling, i18n, BasketCounter],

  data() {
    return {

      events: [],

      // Routes
      routes: {
        get: '/api/basket',
        delete: '/api/basket'
      },

      // States
      isLoaded: false,
    }
  },

  mounted() {
    this.get();
  },

  methods: {

    get() {
      NProgress.start();
      this.isLoaded = false;
      this.axios.get(`${this.routes.get}`).then(response => {
        this.events = response.data;
        this.isLoaded = true;
        NProgress.done();
      });
    },

    remove(uuid) {
      NProgress.start();
      this.axios.delete(`${this.routes.delete}/${uuid}`).then(response => {
        this.updateCounter(response.data.count);
        alert('Der Kurs wurde aus dem Warenkorb gelöscht.');
        this.get();
      });
    },
  },
}
</script>