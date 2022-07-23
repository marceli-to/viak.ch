<template>
  <div>
    <h1>Contact info</h1>
    <div class="checkout-buttons">
      <div>
        <router-link :to="{ name: 'checkout-basket' }" class="btn-previous">
          <icon-arrow-left />
          <span>{{ __('Zurück') }}</span>
        </router-link>
      </div>
      <div>
        <router-link :to="{ name: 'checkout-payment' }" class="btn-next">
          <span>{{ __('Weiter') }}</span>
          <icon-arrow-right />
        </router-link>
      </div>
    </div>
  </div>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import i18n from "@/shared/mixins/i18n";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
import EventCard from "@/modules/checkout/components/EventCard.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";
import IconArrowLeft from "@/shared/components/ui/icons/ArrowLeft.vue";

export default {

  components: {
    NProgress,
    Grid,
    GridCol,
    EventCard,
    IconArrowRight,
    IconArrowLeft,
  },

  mixins: [ErrorHandling, i18n],

  data() {
    return {

      // States
      isLoaded: false,
    }
  },

  mounted() {
  },

  methods: {

  },
}
</script>