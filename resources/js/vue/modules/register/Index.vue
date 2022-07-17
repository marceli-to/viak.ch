<template>
<article-text>
  <template #aside>
    <h1 class="xs:hide">{{ __('Registrieren') }}</h1>
    <div class="sm:mt-10x md:mt-20x">
      <a :href="routes.login" class="!block icon-arrow-right" :title="__('Login')">
        <span>{{ __('Bereits registriert?') }}</span>
        <icon-arrow-right />
      </a>
    </div>
  </template>
  <template #content>
    <form method="POST" class="auth">
      <form-group :label="__('Vorname')" :required="true">
        <input type="text" v-model="form.firstname" required />
      </form-group>
      <form-group :label="__('Name')" :required="true">
        <input type="text" v-model="form.name" required />
      </form-group>
      <form-group :label="__('Telefon')" :required="true">
        <input type="text" v-model="form.phone" required />
      </form-group>
      <grid class="sm:grid-cols-12">
        <form-group :label="__('Strasse')" :required="true" class="span-6">
          <input type="text" v-model="form.street" required />
        </form-group>
        <form-group :label="__('Nr.')" :required="true" class="span-6">
          <input type="text" v-model="form.street_no" required />
        </form-group>
      </grid>
      <grid class="sm:grid-cols-12">
        <form-group :label="__('PLZ')" :required="true" class="span-6">
          <input type="text" v-model="form.zip" required />
        </form-group>
        <form-group :label="__('Ort')" :required="true" class="span-6">
          <input type="text" v-model="form.city" required />
        </form-group>
      </grid>
      <form-group :label="__('E-Mail')" :required="true">
        <input type="email" v-model="form.email" required autocomplete="false" aria-autocomplete="false" />
      </form-group>
      <form-group :label="__('Passwort')" :required="true">
        <input type="password" v-model="form.password" required autocomplete="false" aria-autocomplete="false" />
        <div class="requirements">{{ __('min. 8 Zeichen') }}</div>
      </form-group>
      <form-group>
        <a href="" @click.prevent="submit()" class="btn-primary">
          {{ __('Anmelden') }}
        </a>
      </form-group>
    </form>
  </template>
</article-text>

</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import i18n from "@/shared/mixins/i18n";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";


export default {

  components: {
    NProgress,
    Grid,
    GridCol,
    ArticleText,
    FormGroup,
    IconArrowRight
},

  mixins: [ErrorHandling, i18n],

  data() {
    return {

      form: {
        firstname: null,
        name: null,
        phone: null,
        street: null,
        street_no: null,
        zip: null,
        city: null,
        email: null,
        password: null,
      },

      store: {},

      // Routes
      routes: {
        login: '/login',
        register: '/api/student/register',
      },
    };
  },

  mounted() {
    NProgress.configure({ showBar: false });
  },

  methods: {

    submit() {
      NProgress.start();
      this.axios.post(`${this.routes.register}`, this.form).then(response => {
        NProgress.done();
      });
    },
  },
}
</script>
