<template>
  <div v-if="isLoaded">
    <template v-if="events.length > 0">
      <event-card v-for="event in events" :key="event.uuid" :event="event">
        <a href="" class="btn-secondary btn-auto-w" @click.prevent="remove(event.uuid)">
          {{ __('Entfernen') }}
        </a>
      </event-card>
      <div class="checkout-buttons">
        <router-link :to="{ name: 'checkout-user' }" class="btn-next btn-next-wide span-12">
          <span>{{ __('Weiter') }}</span>
          <icon-arrow-right />
        </router-link>
      </div>
    </template>
    <template v-else>
      <div class="checkout-basket-empty">
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
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
import EventCard from "@/modules/checkout/components/EventCard.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";

export default {

  components: {
    NProgress,
    Grid,
    GridCol,
    EventCard,
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