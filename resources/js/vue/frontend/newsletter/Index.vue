<template>
  <div>
    <h2>{{ __('Newsletter') }}</h2>
    <template v-if="!isSubscribed">
      <p>
        {{ __('Regelmässig über neue Kurse und Angebote informiert werden:') }}
        <a href="javascript:;" @click.prevent="showForm()" :title="__('Newsletter Formular anzeigen')" class="btn-subscribe" v-if="!hasForm">
          <icon-arrow-right :size="'sm'" />
          <span>{{ __('Abonnieren') }}</span>
        </a>
      </p>
      <form method="POST" class="mt-8x" v-if="hasForm">
        <grid class="sm:grid-cols-12 grid-gap-narrow">
          <form-group :label="__('Vorname')" :required="true" class="span-6" :error="errors.firstname">
            <input type="text" v-model="form.firstname" required @focus="removeValidationError('firstname')" />
          </form-group>
          <form-group :label="__('Name')" :required="true" class="span-6" :error="errors.name">
            <input type="text" v-model="form.name" required @focus="removeValidationError('name')" />
          </form-group>
        </grid>
        <form-group :label="__('E-Mail')" :required="true" :error="errors.email">
          <input type="email" v-model="form.email" required autocomplete="new-email" aria-autocomplete="new-email" @focus="removeValidationError('email')" />
        </form-group>
        <form-group class="mb-0">
          <a href="javascript:;" @click.prevent="store()" :class="[$store.state.isLoading ? 'is-disabled' : '', 'btn-subscribe']" :title="__('Newsletter abonnieren')">
            <icon-arrow-right :size="'sm'" />
            <span>{{ __('Abonnieren') }}</span>
          </a>
        </form-group>
      </form>
    </template>
    <template v-else>
      <p>{{ __('Wir haben Deine Anmeldung erhalten, vielen Dank.') }}</p>
    </template>
  </div>
</template>
<script>
import NProgress from 'nprogress';
import i18n from "@/shared/mixins/i18n";
import Validation from "@/shared/mixins/Validation";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";
import FormError from "@/shared/components/ui/form/FormError.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";

export default {

  components: {
    NProgress,
    Grid,
    FormGroup,
    FormError,
    IconArrowRight
  },

  mixins: [i18n, Validation],

  data() {
    return {
      
      form: {
        firstname: null,
        name: null,
        email: null,
      },

      errors: {},
      
      routes: {
        subscribe: '/api/newsletter/subscribe',
      },
      
      isSubscribed: false,
      hasForm: false,
    };
  },

  methods: {

    store() {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.post(`${this.routes.subscribe}`, this.form).then(response => {
        this.isSubscribed = true;
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    showForm() {
      this.hasForm = true;
    }
  },
}
</script>
