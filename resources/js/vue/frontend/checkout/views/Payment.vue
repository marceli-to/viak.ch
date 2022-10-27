<template>
  <div>
    <stacked-list-container v-if="isFetched">
      <stacked-list-header>
        <template #title>
          <h2>{{ __('Zahlung') }}</h2>
        </template>
        <template #step>
          <strong>{{ __('Schritt') }} 3/4</strong>
        </template>
      </stacked-list-header>

      <stacked-list-item>
        <div>
          <div class="sm:span-4">
            <strong>{{ __('Zahlungsoptionen') }}</strong>
          </div>
          <div class="sm:span-8">
            <!-- {{ __('per Rechnung') }} -->
            {{ __('Unsere Rechnungen können entweder mittels QR-Einzahlungsschein oder per Kreditkarte bezahlt werden. Die Rechnungsstellung erfolgt sobald die Durchführung eines Kurses feststeht.') }}
          </div>
        </div>
      </stacked-list-item>

      <stacked-list-item>
        <div>
          <div class="sm:span-4">
            <strong v-if="!isValid" class="text-danger">
              {{ __('Gutschein-Code ist ungültig!') }}
            </strong>
            <strong v-else>
              {{ __('Gutschein-Code') }}
            </strong>
          </div>
          <div class="sm:span-4">
            <form-group class="mb-0">
              <input 
                type="text"
                name="discount_code" 
                v-model="discount_code" 
                class="is-plain" 
                :placeholder="__('Code eingeben')"
                @focus="isValid = true">
            </form-group>
          </div>
        </div>
      </stacked-list-item>

      <stacked-list-footer>
        <div>
          <router-link :to="{ name: 'checkout-user' }" class="btn-previous">
            <icon-arrow-left />
            <span>{{ __('Zurück') }}</span>
          </router-link>
        </div>
        <div>
          <a href="javascript:;" class="btn-next" @click.prevent="submit()">
            <span>{{ __('Weiter') }}</span>
            <icon-arrow-right />
          </a>
        </div>
      </stacked-list-footer>
    </stacked-list-container>
  </div>
</template>
<script>
import NProgress from 'nprogress';
import Helpers from "@/shared/mixins/Helpers";
import i18n from "@/shared/mixins/i18n";
import Basket from "@/shared/mixins/Basket";
import StackedListContainer from "@/shared/components/ui/layout/StackedListContainer.vue";
import StackedListItem from "@/shared/components/ui/layout/StackedListItem.vue";
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
    StackedListHeader,
    StackedListFooter,
    IconArrowRight,
    IconArrowLeft,
    IconEdit,
    FormGroup
  },

  mixins: [i18n, Helpers, Basket],

  data() {
    return {

      basket: {
      },

      // Data
      discount_code: null,

      // Routes
      routes: {
        basket: {
          payment: '/api/basket/add/payment-info'
        },
        discount: {
          check: '/api/discount-code/check'
        }
      },

      // States
      isFetched: true,
      isValid: true,
    }
  },

  mounted() {
    this.getBasket();
  },

  methods: {

    getBasket() {
      NProgress.start();
      this.isFetched = false;
      this.axios.get(`${this.routes.basket.get}`).then(response => {
        this.basket = response.data;
        if (this.basket.discount_code) {
          this.discount_code = this.basket.discount_code;
        }
        this.isFetched = true;
        NProgress.done();
      });
    },

    submit() {
      if (this.discount_code && !this.validateCode()) {
        return false;
      }
      this.store();
    },

    store() {
      NProgress.start();
      this.axios.put(`${this.routes.basket.payment}`, {'discount_code': this.discount_code}).then((response) => {
        this.$router.push({ name: 'checkout-summary' });
        NProgress.done();
      });  
    },

    validateCode() {
      if (this.discount_code.length < 12) {
        this.isValid = false;
        return false;
      }

      NProgress.start();
      this.axios.get(`${this.routes.discount.check}/${this.discount_code}`).then(response => {
        this.isValid = true;
        this.store();
      }).catch((errors) => {
        this.isValid = false;
        NProgress.done();
        return false;
      });
    },
  },
}
</script>