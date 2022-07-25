<template>
  <div>
    <checkout-header>
      <template #title>
        {{ __('Zahlung') }}
      </template>
      <template #step>
        {{ __('Schritt') }} 3/4
      </template>
    </checkout-header>

    <checkout-card>
      <div>
        <div class="span-3">
          <strong>{{ __('Zahlungsoption') }}</strong>
        </div>
        <div class="span-9">
          {{ __('per Rechnung') }}
        </div>
      </div>
    </checkout-card>

    <checkout-card>
      <div>
        <div class="span-3">
          <strong>{{ __('Gutschein-Code') }}</strong>
        </div>
        <div class="span-9">
          <form-group :error="errors.voucher" class="mb-0">
            <input type="text" name="voucher" v-model="form.voucher" class="is-plain" :placeholder="__('Code eingeben')">
          </form-group>
        </div>
      </div>
    </checkout-card>

    <checkout-footer>
      <div>
        <router-link :to="{ name: 'checkout-user' }" class="btn-previous">
          <icon-arrow-left />
          <span>{{ __('Zurück') }}</span>
        </router-link>
      </div>
      <div>
        <a href="javascript:;" :to="{ name: 'checkout-summary' }" class="btn-next" @click.prevent="submit()">
          <span>{{ __('Weiter') }}</span>
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
      form: {
        voucher: null,
      },

      errors: {
        voucher: false,
      },

      // Routes
      routes: {
        addPayment: '/api/basket/add/payment'
      },

      // States
      isLoaded: true,
    }
  },

  mounted() {
  },

  methods: {

    submit() {
      NProgress.start();
      this.axios.put(`${this.routes.addPayment}`, this.form).then((response) => {
        this.$router.push({ name:'checkout-summary' });
        NProgress.done();
      });
    },

  },
}
</script>