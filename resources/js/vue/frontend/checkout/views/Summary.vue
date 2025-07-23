<template>
  <stacked-list-container v-if="isLoaded">
    
    <stacked-list-header>
      <template #title>
        <h2>{{ __('Zusammenfassung') }}</h2>
      </template>
      <template #step>
        <strong>{{ __('Schritt') }} 4/4</strong>
      </template>
    </stacked-list-header>

    <stacked-list-item v-if="basket.user_address">
      <div>
        <div class="sm:span-4">
          <strong>{{ __('Adresse') }}</strong>
          <div v-html="basket.user_address"></div>
        </div>
        <template v-if="basket.invoice_address">
          <div class="mt-3x sm:mt-0 sm:span-8">
            <strong>{{ __('Rechnungsadresse') }}</strong>
            <div v-html="basket.invoice_address"></div>
          </div>
        </template>
      </div>
    </stacked-list-item>

    <stacked-list-event 
      v-for="event in basket.events" 
      :key="event.uuid" 
      :event="event" 
      :is_basket="true">
    </stacked-list-event>

    <stacked-list-item v-if="basket.totals.discount > 0">
      <div>
        <div class="sm:span-4">
          {{ __('Zwischentotal') }}
        </div>
        <div class="sm:span-8 sm:align-right">
          CHF {{ basket.totals.total | currency }}
        </div>
      </div>
    </stacked-list-item>

    <stacked-list-item v-if="basket.totals.discount > 0">
      <div>
        <div class="sm:span-4">
          {{ __('Gutschein-Code') }} <strong>{{ basket.discount_code }}</strong>
        </div>
        <div class="sm:span-8 sm:align-right">
          – CHF {{ basket.totals.discount | currency }}
        </div>
      </div>
    </stacked-list-item>
    <stacked-list-item v-if="basket.totals.grandTotal > 0">
      <div>
        <div class="sm:span-4">
          <strong>{{ __('Total') }}</strong><br>
          {{ __('exkl. Mehrwertsteuer') }}
        </div>
        <div class="sm:span-8 sm:align-right">
          <template v-if="basket.totals.discount > 0">
            <strong>CHF {{ basket.totals.grandTotal - basket.totals.discount | currency }}</strong>
          </template>
          <template v-else>
            CHF {{ basket.totals.grandTotal | currency }}
          </template>
        </div>
      </div>
    </stacked-list-item>
    <stacked-list-footer>
      <div>
        <router-link :to="{ name: `${_getLocale()}-checkout-payment` }" class="btn-previous">
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
    </stacked-list-footer>
  </stacked-list-container>
</template>
<script>
import NProgress from 'nprogress';
import Validation from "@/shared/mixins/Validation";
import Helpers from "@/shared/mixins/Helpers";
import i18n from "@/shared/mixins/i18n";
import StackedListContainer from "@/shared/components/ui/layout/StackedListContainer.vue";
import StackedListItem from "@/shared/components/ui/layout/StackedListItem.vue";
import StackedListEvent from "@/shared/components/ui/layout/StackedListEvent.vue";
import StackedListHeader from "@/shared/components/ui/layout/StackedListHeader.vue";
import StackedListFooter from "@/shared/components/ui/layout/StackedListFooter.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";
import IconArrowLeft from "@/shared/components/ui/icons/ArrowLeft.vue";
import IconEdit from "@/shared/components/ui/icons/Edit.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";

export default {

  components: {
    NProgress,
    StackedListContainer,
    StackedListItem,
    StackedListEvent,
    StackedListHeader,
    StackedListFooter,
    IconArrowRight,
    IconArrowLeft,
    IconEdit,
    FormGroup
  },

  mixins: [Validation, i18n, Helpers],

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
        confirmation: `/${this._getLocale()}/checkout/confirmation`
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