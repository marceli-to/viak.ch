<template>
  <stacked-list-container>
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
          <strong>{{ __('Zahlungsoption') }}</strong>
        </div>
        <div class="sm:span-8">
          {{ __('per Rechnung') }}
        </div>
      </div>
    </stacked-list-item>

    <stacked-list-item>
      <div>
        <div class="sm:span-4">
          <strong>{{ __('Gutschein-Code') }}</strong>
        </div>
        <div class="sm:span-4">
          <form-group :error="errors.voucher" class="mb-0">
            <input type="text" name="voucher" v-model="form.voucher" class="is-plain" :placeholder="__('Code eingeben')">
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
        <a href="javascript:;" :to="{ name: 'checkout-summary' }" class="btn-next" @click.prevent="submit()">
          <span>{{ __('Weiter') }}</span>
          <icon-arrow-right />
        </a>
      </div>
    </stacked-list-footer>
  </stacked-list-container>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import Helpers from "@/shared/mixins/Helpers";
import i18n from "@/shared/mixins/i18n";
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