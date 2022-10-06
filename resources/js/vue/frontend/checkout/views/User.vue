<template>
  <div>
    <stacked-list-container v-if="isFetched">
      <stacked-list-header>
        <template #title>
          <h2>{{ __('Kontakt') }}</h2>
        </template>
        <template #step>
          <strong>{{ __('Schritt') }} 2/4</strong>
        </template>
      </stacked-list-header>
      <stacked-list-item>
        <div>
          <div class="sm:span-4">
            <strong>{{ __('Kursteilnehmer') }}</strong>
          </div>
          <div class="sm:span-8">
            <span v-html="user.address"></span>
          </div>
        </div>
      </stacked-list-item>
      <stacked-list-item>
        <div class="relative">
          <a href="" class="icon-edit" @click.prevent="toggleForm()">
            <icon-edit />
          </a>
          <div class="sm:span-4">
            <strong>{{ __('Rechnungsadresse') }}</strong>
          </div>
          <div class="sm:span-8">

            <!-- non edit mode -->
            <template v-if="!isEdit">
              <template v-if="user.has_invoice_address">
                <div v-html="user.invoice_address.address"></div>
              </template>
              <template v-else>
                <em>
                  {{ __('Rechnungsadresse entspricht der Kursteilnehmer-Adresse') }}
                </em>
              </template>
            </template>

            <!-- edit mode -->
            <template v-if="isEdit">
              <form-group :label="__('Firma')" :error="errors.invoice_address_company">
                <input type="text" v-model="form.invoice_address.company" @focus="removeError('invoice_address_company')" />
              </form-group>
              <grid class="sm:grid-cols-12">
                <form-group :label="__('Vorname')" class="sm:span-6" :error="errors.invoice_address_firstname">
                  <input type="text" v-model="form.invoice_address.firstname" @focus="removeError('invoice_address_firstname')" />
                </form-group>
                <form-group :label="__('Name')" class="sm:span-6" :error="errors.invoice_address_name">
                  <input type="text" v-model="form.invoice_address.name" @focus="removeError('invoice_address_name')" />
                </form-group>
              </grid>
              <grid class="sm:grid-cols-12">
                <form-group :label="__('Strasse')" :required="true" class="span-6" :error="errors.invoice_address_street">
                  <input type="text" v-model="form.invoice_address.street" required @focus="removeError('invoice_address_street')" />
                </form-group>
                <form-group :label="__('Nr.')" class="span-6">
                  <input type="text" v-model="form.invoice_address.street_no" maxlength="5" />
                </form-group>
              </grid>
              <grid class="sm:grid-cols-12">
                <form-group :label="__('PLZ')" :required="true" class="span-6" :error="errors.invoice_address_zip">
                  <input type="text" v-model="form.invoice_address.zip" required maxlength="10" @focus="removeError('invoice_address.zip')" />
                </form-group>
                <form-group :label="__('Ort')" :required="true" class="span-6" :error="errors.invoice_address_city">
                  <input type="text" v-model="form.invoice_address.city" required @focus="removeError('invoice_address_city')" />
                </form-group>
              </grid>
              <form-group :label="__('Land')" :required="true">
                <div class="select-wrapper" v-if="isFetchedSettings">
                  <select v-model="form.invoice_address.country_id">
                    <option 
                      v-for="(option) in settings.countries" 
                      :key="option.id" 
                      :value="option.id">
                      {{ option.name }}
                    </option>
                  </select>
                </div>
              </form-group>
              <form-group class="flex items-center">
                <input type="checkbox" id="update_profile" name="update_profile" required value="1" v-model="form.update_profile">
                <label for="update_profile">
                  <em>{{ __('Änderungen im Profil speichern' )}}</em>
                </label>
              </form-group>
            </template>
          </div>
        </div>
      </stacked-list-item>

      <stacked-list-footer>
        <div>
          <router-link :to="{ name: 'checkout-basket' }" class="btn-previous">
            <icon-arrow-left />
            <span>{{ __('Zurück') }}</span>
          </router-link>
        </div>
        <div>
          <a href="" @click.prevent="next()" class="btn-next">
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
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import Helpers from "@/shared/mixins/Helpers";
import i18n from "@/shared/mixins/i18n";
import Grid from "@/shared/components/ui/layout/Grid.vue";
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
    Grid,
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

      // User data
      user: {
      },

      // Form data
      form: {
        invoice_address: false,
        update_profile: true,
      },

      // Settings
      settings: {
        countries: null
      },

      // Errors
      errors: {
      },

      // Routes
      routes: {

        student: {
          get: '/api/student',
          update: '/api/student/address',
        },

        countries: {
          get: '/api/countries',
        },
        
        basket: {
          customer: '/api/basket/customer',
          customerAddress: '/api/basket/customer/address'
        }
      },

      // States
      isFetched: true,
      isLoading: false,
      isEdit: false,
      isFetchedSettings: false,
    }
  },

  mounted() {
    this.fetch();
    this.fetchSettings();
  },

  methods: {

    fetch() {
      NProgress.start();
      this.isFetched = false;
      this.isEdit = false;
      this.axios.get(`${this.routes.student.get}`).then(response => {
        this.user = response.data;
        this.form.invoice_address = this.user.invoice_address ? this.user.invoice_address : {};
        this.isFetched = true;
        NProgress.done();
      });
    },

    fetchSettings() {
      this.isFetchedSettings = false;
      NProgress.start();
      this.axios.get(`${this.routes.countries.get}`).then(response => {
        this.settings.countries = response.data;
        this.isFetchedSettings = true;
        NProgress.done();
      });
    },

    next() {
      if (!this.user.has_invoice_address && !this.isEdit) {
        NProgress.start();
        this.axios.put(`${this.routes.basket.customer}`).then(response => {
          this.$router.push({ name: 'checkout-payment' });
          NProgress.done();
        });
      }

      if (this.isEdit) {
        NProgress.start();
        this.axios.put(`${this.routes.basket.customerAddress}`, this.form).then(response => {
          this.$router.push({ name: 'checkout-payment' });
          NProgress.done();
        });
      }
    },
    
    update() {

      if (this.form.update_profile) {
        NProgress.start();
        this.axios.put(`${this.routes.student.update}`, this.form).then(response => {
          NProgress.done();
        });
      }
    },


    cancel() {
      this.hideForm();
    },

    showForm() {
      this.isEdit = true;
      this.errors = {};
    },

    hideForm() {
      this.isEdit = false;
      this.errors = {};
    },

    toggleForm() {
      this.isEdit = this.isEdit ? false : true;
      this.errors = {};
    },

  },
}
</script>