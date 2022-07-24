<template>
  <div v-if="isLoaded">
    <checkout-header>
      <template #title>
        {{ __('Kontaktangaben') }}
      </template>
      <template #step>
        {{ __('Schritt') }} 2/4
      </template>
    </checkout-header>

    <article class="card-checkout" data-touch>
      <div>
        <div class="span-3">
          <strong>Kursteilnehmer</strong>
        </div>
        <div class="span-9">
          {{ user.fullname}}
        </div>
      </div>
    </article>

    <article class="card-checkout" data-touch>
      <div class="relative">
        <a href="" class="icon-edit" @click.prevent="toggle()">
          <icon-edit />
        </a>
        <div class="span-3">
          <strong>Rechnungsadresse</strong>
        </div>
        <div class="span-9">
          <template v-if="!isEdit">
            <span v-html="user.address"></span>
          </template>
          <template v-else>
          <form-group :error="errors.invoice_address" class="mb-0">
            <textarea 
              v-model="form.invoice_address" 
              :placeholder="__('Rechnungsadresse')" 
              class="is-plain mb-2x sm:mb-4x pt-0">
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
    </article>

    <checkout-footer>
      <div>
        <router-link :to="{ name: 'checkout-basket' }" class="btn-previous">
          <icon-arrow-left />
          <span>{{ __('Zurück') }}</span>
        </router-link>
      </div>
      <div>
        <router-link :to="{ name: 'checkout-payment' }" class="btn-next">
          <span>{{ __('Weiter') }}</span>
          <icon-arrow-right />
        </router-link>
      </div>
    </checkout-footer>

  </div>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import i18n from "@/shared/mixins/i18n";
import CheckoutHeader from "@/modules/checkout/components/Header.vue";
import CheckoutFooter from "@/modules/checkout/components/Footer.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";
import IconArrowLeft from "@/shared/components/ui/icons/ArrowLeft.vue";
import IconEdit from "@/shared/components/ui/icons/Edit.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";

export default {

  components: {
    NProgress,
    CheckoutHeader,
    CheckoutFooter,
    IconArrowRight,
    IconArrowLeft,
    IconEdit,
    FormGroup
  },

  mixins: [ErrorHandling, i18n],

  data() {
    return {

      user: {

      },

      form: {
        update_profile: false,
        invoice_address: null,
      },

      errors: {
        invoice_address: null
      },

      // Routes
      routes: {
        get: '/api/student',
        update: '/api/basket'
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
        this.isLoaded = true;
        NProgress.done();
      });
    },

    toggle() {
      this.isEdit = this.isEdit ? false : true;
    }
  },
}
</script>