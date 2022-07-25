<template>
  <div v-if="isLoaded">
    
    <checkout-header>
      <template #title>
        <h2>{{ __('Zusammenfassung') }}</h2>
      </template>
      <template #step>
        <strong>{{ __('Schritt') }} 4/4</strong>
      </template>
    </checkout-header>

    <checkout-card-event v-for="event in basket.events" :key="event.uuid" :event="event" />

    <checkout-card>
      <div>
        <div class="span-3">
          {{ __('Zwischentotal') }}
        </div>
        <div class="span-9 align-right">
          CHF {{ basket.totals.total | currency }}
        </div>
      </div>
    </checkout-card>

    <checkout-card>
      <div>
        <div class="span-3">
          {{ __('MwSt 7.7%') }}
        </div>
        <div class="span-9 align-right">
          CHF {{ basket.totals.vat | currency }}
        </div>
      </div>
    </checkout-card>

    <checkout-card>
      <div>
        <div class="span-3">
          <strong>{{ __('Total') }}</strong>
        </div>
        <div class="span-9 align-right">
          <strong>CHF {{ basket.totals.grandTotal | currency }}</strong>
        </div>
      </div>
    </checkout-card>

    <checkout-footer>
      <div>
        <router-link :to="{ name: 'checkout-payment' }" class="btn-previous">
          <icon-arrow-left />
          <span>{{ __('Zurück') }}</span>
        </router-link>
      </div>
      <div>
        <a href="javascript:;" class="btn-next" @click.prevent="submit()">
          <span>{{ __('Buchen') }}</span>
          <icon-arrow-right />
        </a>
      </div>

    </checkout-footer>

  </div>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import Helpers from "@/shared/mixins/Helpers";
import i18n from "@/shared/mixins/i18n";
import CheckoutCard from "@/modules/checkout/components/Card.vue";
import CheckoutCardEvent from "@/modules/checkout/components/CardEvent.vue";
import CheckoutHeader from "@/modules/checkout/components/Header.vue";
import CheckoutFooter from "@/modules/checkout/components/Footer.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";
import IconArrowLeft from "@/shared/components/ui/icons/ArrowLeft.vue";
import IconEdit from "@/shared/components/ui/icons/Edit.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";

export default {

  components: {
    NProgress,
    CheckoutCard,
    CheckoutCardEvent,
    CheckoutHeader,
    CheckoutFooter,
    IconArrowRight,
    IconArrowLeft,
    IconEdit,
    FormGroup
  },

  mixins: [ErrorHandling, i18n, Helpers],

  data() {
    return {
      
      // Data
      basket: {
        events: [],
        totals: {},
      },

      // Routes
      routes: {
        get: '/api/basket',
        create: '/api/booking',
        confirmation: '/checkout/confirmation'
      },

      // States
      isLoaded: true,
      isEdit: false,
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

    submit() {
      NProgress.start();
      this.axios.post(`${this.routes.create}`).then(response => {
        NProgress.done();
        window.location.href = this.routes.confirmation;
      });
    }
  },
}
</script>