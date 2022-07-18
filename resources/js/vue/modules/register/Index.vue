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
  <template #content v-if="!isRegistered">
    <form method="POST">
      <form-group :label="__('Geschlecht')" :required="true">
        <div class="select-wrapper">
          <select v-model="form.gender_id">
            <option value="null">Geschlecht</option>
            <option 
              v-for="(option, id) in settings.genders" 
              :key="id" 
              :value="id">
              {{option.description[_getLocale()]}}
            </option>
          </select>
        </div>
      </form-group>
      <form-group :label="__('Vorname')" :required="true">
        <input type="text" v-model="form.firstname" required />
      </form-group>
      <form-group :label="__('Name')" :required="true">
        <input type="text" v-model="form.name" required />
      </form-group>
      <form-group :label="__('Telefon')">
        <input type="text" v-model="form.phone" maxlength="15" />
      </form-group>
      <grid class="sm:grid-cols-12">
        <form-group :label="__('Strasse')" :required="true" class="span-6">
          <input type="text" v-model="form.street" required />
        </form-group>
        <form-group :label="__('Nr.')" class="span-6">
          <input type="text" v-model="form.street_no" maxlength="5" />
        </form-group>
      </grid>
      <grid class="sm:grid-cols-12">
        <form-group :label="__('PLZ')" :required="true" class="span-6">
          <input type="text" v-model="form.zip" required maxlength="10" />
        </form-group>
        <form-group :label="__('Ort')" :required="true" class="span-6">
          <input type="text" v-model="form.city" required />
        </form-group>
      </grid>
      <form-group class="has-underline">
        <div class="flex items-center">
          <input type="checkbox" id="has_invoice_address" name="has_invoice_address" required value="1" v-model="form.has_invoice_address">
          <label for="has_invoice_address"><em>{{__('Rechnungsadresse (abweichend)')}}</em></label>
        </div>
        <textarea v-model="form.invoice_address" :placeholder="__('Rechnungsadresse')" class="is-plain mt-2x sm:mt-4x" v-if="form.has_invoice_address"></textarea>
      </form-group>
      <form-group :label="__('E-Mail')" :required="true">
        <input type="email" v-model="form.email" required autocomplete="false" aria-autocomplete="false" />
      </form-group>
      <form-group :label="__('Passwort')" :required="true">
        <input type="password" v-model="form.password" required autocomplete="false" aria-autocomplete="false" />
        <div class="requirements">{{ __('min. 8 Zeichen') }}</div>
      </form-group>
      <form-group-header>
        <h3>{{__('Betriebssystem')}} *</h3>
      </form-group-header>
      <form-group>
        <div class="flex items-center">
          <input type="checkbox" id="os_win" name="os_win" required value="Windows" v-model="form.os">
          <label for="os_win">Windows</label>
        </div>
      </form-group>
      <form-group class="has-underline">
        <div class="flex items-center">
          <input type="checkbox" id="os_mac" name="os_mac" required value="macOS" v-model="form.os">
          <label for="os_mac">macOS</label>
        </div>
      </form-group>
      <form-group class="has-underline">
        <div class="flex items-center mb-2x md:mb-4x">
          <input type="checkbox" id="accept_tos" name="accept_tos" required value="1" v-model="form.accept_tos">
          <label for="accept_tos">{{ __('Ich akzeptiere die AGB und Datenschutzbestimmungen') }}</label>
        </div>
        <ul>
          <li>
            <a href="/media/downloads/viak_agb.pdf" target="_blank" :title="__('Download AGB')">
              {{ __('Allgemeine Geschäftsbedingungen') }}
            </a>
          </li>
          <li>
            <a href="/media/downloads/viak_datenschutzbestimmungen.pdf" target="_blank" :title="__('Download Datenschutzbestimmungen')">
              {{ __('Datenschutzbestimmungen') }}
            </a>
          </li>
        </ul>
      </form-group>
      <form-group class="has-underline">
        <div class="flex items-center">
          <input type="checkbox" id="subscribe_newsletter" name="subscribe_newsletter" required value="1" v-model="form.subscribe_newsletter">
          <label for="subscribe_newsletter">{{ __('Ich möchte den Newsletter abonnieren.') }}</label>
        </div>
      </form-group>
      <form-group>
        <a href="" @click.prevent="submit()" :class="[isLoading ? 'disabled' : '', 'btn-primary']">
          {{ __('Anmelden') }}
        </a>
      </form-group>
    </form>
  </template>
  <template #content v-else>
    <p>{{ __('Vielen Dank für deine Anmeldung. Du erhälst in den nächsten Minuten eine E-Mail, um deine Anmeldung zu verifizieren.') }}</p>
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
import FormGroupHeader from "@/shared/components/ui/form/FormGroupHeader.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";

export default {

  components: {
    NProgress,
    Grid,
    GridCol,
    ArticleText,
    FormGroup,
    FormGroupHeader,
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
        os: [],
        has_invoice_address: false,
        invoice_address: null,
        accept_tos: false,
        subscribe_newsletter: false,
        gender_id: null,
      },

      settings: {
        genders: [],
      },

      store: {},

      // States
      isValid: false,
      isFetched: false,
      isRegistered: false,
      isLoading: false,

      // Routes
      routes: {
        login: '/login',
        register: '/api/student/register',
        settings: '/api/genders',
      },
    };
  },

  mounted() {
    NProgress.configure({ showBar: false });
    this.getSettings();
  },

  methods: {

    submit() {
      if (this.form.accept_tos == false) {
        alert(this.__('Bitte AGB und Datenschutzbestimmungen akzeptieren!'));
        return false;
      }
      if (this.validate()) {
        NProgress.start();
        this.isLoading = true;
        this.axios.post(`${this.routes.register}`, this.form).then(response => {
          NProgress.done();
          this.isRegistered = true;
          this.isLoading = false;
        });
      }
    },

    getSettings() {
      this.isFetched = false;
      NProgress.start();
      this.axios.get(`${this.routes.settings}`).then(response => {
        this.settings.genders = response.data;
        this.isFetched = true;
        NProgress.done();
      });
    },

    validate() {
      if (
        !this.form.firstname ||
        !this.form.name ||
        !this.form.street ||
        !this.form.zip ||
        !this.form.city ||
        !this.form.email ||
        !this.form.password ||
        this.form.os.length == 0 ||
        !this.form.gender_id// ||
        //(this.form.has_invoice_address && this.form.invoice_address == null)
      ) {
        alert('Bitte alle markierten Felder überprüfen!');
        return false;
      }
      return true;
    },

    reset() {

    },
  },
}
</script>
