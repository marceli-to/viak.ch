<template>
  <stacked-list-container v-if="isLoaded">
    <template v-if="basket.events.length > 0">

      <stacked-list-header>
        <template #title>
          <h2>{{ __('Übersicht') }}</h2>
        </template>
        <template #step>
          <strong>{{ __('Schritt') }} 1/4</strong>
        </template>
      </stacked-list-header>

      <stacked-list-event v-for="event in basket.events" :key="event.uuid" :event="event">
        <template #action>
          <a href="" class="btn-secondary btn-auto-w" @click.prevent="remove(event.uuid)">
            {{ __('Entfernen') }}
          </a>
        </template>
      </stacked-list-event>

      <stacked-list-footer>
        <router-link :to="{ name: 'checkout-user' }" class="btn-next btn-next-wide span-12">
          <span>{{ __('Weiter') }}</span>
          <icon-arrow-right />
        </router-link>
      </stacked-list-footer>

    </template>

    <template v-else>
      <div class="checkout-basket-empty">
        {{ __('Dein Warenkorb ist leer...') }}
      </div>
    </template>
  </stacked-list-container>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import BasketCounter from "@/shared/mixins/BasketCounter";
import i18n from "@/shared/mixins/i18n";
import StackedListContainer from "@/shared/components/ui/layout/StackedListContainer.vue";
import StackedListEvent from "@/shared/components/ui/layout/StackedListEvent.vue";
import StackedListHeader from "@/shared/components/ui/layout/StackedListHeader.vue";
import StackedListFooter from "@/shared/components/ui/layout/StackedListFooter.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";

export default {

  components: {
    NProgress,
    StackedListContainer,
    StackedListEvent,
    StackedListHeader,
    StackedListFooter,
    IconArrowRight
  },

  mixins: [ErrorHandling, i18n, BasketCounter],

  data() {
    return {

      // Data
      basket: {
        events: [],
      },

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
        this.basket = response.data;
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