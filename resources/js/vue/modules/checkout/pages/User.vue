<template>
  <div v-if="isLoaded">
    <checkout-header>
      <template #title>
        {{ __('Kontakt') }}
      </template>
      <template #step>
        {{ __('Schritt') }} 2/4
      </template>
    </checkout-header>

    <checkout-card>
      <div>
        <div class="span-3">
          <strong>{{ __('Kursteilnehmer') }}</strong>
        </div>
        <div class="span-9">
          <span v-html="user.address"></span>
        </div>
      </div>
    </checkout-card>
    
    <checkout-card>
      <div class="relative">
        <a href="" class="icon-edit" @click.prevent="toggle()">
          <icon-edit />
        </a>
        <div class="span-3">
          <strong>{{ __('Rechnungsadresse') }}</strong>
        </div>
        <div class="span-9">
          <template v-if="!isEdit">
            <span v-html="nl2br(form.invoice_address)"></span>
          </template>
          <template v-else>
          <form-group :error="errors.invoice_address">
            <textarea 
              v-model="form.invoice_address" 
              :placeholder="__('Rechnungsadresse')" 
              class="is-plain mb-2x sm:mb-4x">
            </textarea>
            <div class="flex items-center">
              <input type="checkbox" id="update_profile" name="update_profile" required value="1" v-model="form.update_profile">
              <label for="update_profile">
                <em>{{ __('Änderungen im Profil speichern' )}}</em>
              </label>
            </div>
          </form-group>
          </template>
        </div>
      </div>
    </checkout-card>

    <checkout-footer>
      <div>
        <router-link :to="{ name: 'checkout-basket' }" class="btn-previous">
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

      // User data
      user: {},

      // Form data
      form: {
        update_profile: false,
        invoice_address: null,
      },

      // Errors
      errors: {
        invoice_address: null
      },

      // Routes
      routes: {
        get: '/api/student',
        addUser: '/api/basket/add/user'
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
      this.axios.get(`${this.routes.get}/true`).then(response => {
        this.user = response.data;
        this.form.invoice_address = this.user.invoice_address;
        this.form.update_profile = this.user.has_invoice_address;
        this.isLoaded = true;
        NProgress.done();
      });
    },

    submit() {
      NProgress.start();
      this.axios.put(`${this.routes.addUser}`, this.form).then((response) => {
        this.$router.push({ name:'checkout-payment' });
        NProgress.done();
      });
    },

    toggle() {
      this.isEdit = this.isEdit ? false : true;
    }
  },
}
</script>