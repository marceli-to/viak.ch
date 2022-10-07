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
            <div v-if="isValidated">
              <strong v-if="isValid">{{ __('Gutschein-Code ist gültig') }}</strong>
              <strong v-else-if="!isValid" class="text-danger">{{ __('Gutschein-Code is ungültig') }}</strong>            
            </div>
            <div v-else>
              <strong>{{ __('Gutschein-Code') }}</strong>
            </div>
          </div>
          <div class="sm:span-4">
            <form-group class="mb-0">
              <input 
                type="text"
                name="discount_code" 
                v-model="form.discount_code" 
                class="is-plain" 
                :placeholder="__('Code eingeben')"
                @blur="validate()">
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
    <notification ref="notification" />
  </div>
</template>
<script>
import NProgress from 'nprogress';
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

  mixins: [i18n, Helpers],

  data() {
    return {

      // Data
      form: {
        discount_code: '',
      },

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
      isValidated: false,
      isValid: true,
    }
  },

  methods: {

    submit() {
      NProgress.start();
      this.axios.put(`${this.routes.basket.payment}`, this.form).then((response) => {
        this.$router.push({ name:'checkout-summary' });
        NProgress.done();
      });
    },

    validate() {
      if (this.form.discount_code.length > 3) {
        NProgress.start();
        this.axios.get(`${this.routes.discount.check}/${this.form.discount_code}`).then(response => {
          this.isValid = true;
          this.isValidated = true;
          NProgress.done();
        }).catch((errors) => {
          this.isValid = false;
          this.isValidated = true;
          NProgress.done();
        });
      }
    },
  },
}
</script>