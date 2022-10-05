<template>
  <stacked-list-container v-if="isLoaded">
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
        <a href="" class="icon-edit" @click.prevent="toggle()">
          <icon-edit />
        </a>
        <div class="sm:span-4">
          <strong>{{ __('Rechnungsadresse') }}</strong>
        </div>
        <div class="sm:span-8">
           
          <template v-if="user.has_invoice_address && !isEdit">
            <span 
              v-html="nl2br(user.invoice_address.address)" 
              v-if="user.invoice_address">
            </span>
          </template>

          <template v-else-if="user.has_invoice_adress || isEdit">
            <span v-html="nl2br(user.invoice_address.address)" v-if="isEdit == false"></span>
            <div v-else>
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
                      {{option.name[_getLocale()]}}
                    </option>
                  </select>
                </div>
              </form-group>
              <div class="flex items-center">
                <input type="checkbox" id="update_profile" name="update_profile" required value="1" v-model="hasProfileUpdate">
                <label for="update_profile">
                  <em>{{ __('Änderungen im Profil speichern' )}}</em>
                </label>
              </div>
            </div>
          </template>

          <template v-else>
            <em>Stimmt mit Teilnehmer-Adresse überein.</em>
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
        <a href="javascript:;" class="btn-next" @click.prevent="submit()">
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
        invoice_address: {
          address: null
        }
      },

      settings: {
        countries: null
      },

      // Form data
      form: {
        update_profile: false,
        invoice_address: {
          country_id: 1,
        }
      },

      // Errors
      errors: {
        invoice_address: null
      },

      // Routes
      routes: {
        get: '/api/student',
        getCountries: '/api/countries',
        update: '/api/student/address',
        addUser: '/api/basket/add/user'
      },

      // States
      isLoaded: true,
      isEdit: false,
      isFetchedSettings: false,
      hasProfileUpdate: false,
    }
  },

  mounted() {
    this.get();
    this.fetchCountries();
  },

  methods: {

    get() {
      NProgress.start();
      this.isLoaded = false;
      this.isEdit = false;
      this.axios.get(`${this.routes.get}`).then(response => {
        this.user = response.data;
        this.form.invoice_address = this.user.invoice_address ? this.user.invoice_address : {};
        this.form.update_profile = this.user.has_invoice_address;
        this.isLoaded = true;
        NProgress.done();
      });
    },

    fetchCountries() {
      this.isFetchedSettings = false;
      NProgress.start();
      this.axios.get(`${this.routes.getCountries}`).then(response => {
        this.settings.countries = response.data;
        this.isFetchedSettings = true;
        NProgress.done();
      });
    },


    submit() {

      if (this.isEdit) {
        if (this.hasProfileUpdate) {
          NProgress.start();
          this.axios.put(`${this.routes.update}`, this.form).then(response => {
            NProgress.done();
            this.get();
          });
        }
        else {
          NProgress.start();
          this.axios.put(`${this.routes.addUser}`, this.form).then((response) => {
            this.$router.push({ name: 'checkout-payment' });
            NProgress.done();
          });
        }
      }
    },

    toggle() {
      this.isEdit = this.isEdit ? false : true;
    }
  },
}
</script>