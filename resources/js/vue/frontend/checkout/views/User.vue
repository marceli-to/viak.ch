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
          <div class="sm:span-4">
            <strong>{{ __('Rechnungsadresse') }}</strong>
          </div>
          <div class="sm:span-8">
            <form-group>
              <div class="flex items-center xs:mt-2x md:mb-3x">
                <input type="checkbox" id="toggle_addresses" name="toggle_addresses" :checked="hasAdresses ? false : true" @change="toggle()">
                <label for="toggle_addresses">
                  <em>{{ __('entspricht Teilnehmer-Adresse' )}}</em>
                </label>
              </div>
              <template v-if="hasAdresses">
                <div class="select-wrapper">
                  <select v-model="form.address_uuid">
                    <option :value="null">{{ __('Bitte wählen...') }}</option>
                    <option 
                      v-for="(address) in user.invoice_addresses" 
                      :key="address.uuid" 
                      :value="address.uuid">
                      {{ address.address_str }}
                    </option>
                  </select>
                </div>
                <div class="mt-1x sm:mt-2x align-right">
                  <a href="/de/student/profil" class="text-xsmall link-underline">
                    {{ __('Adressen verwalten') }}
                  </a>
                </div>
              </template>
            </form-group>
          </div>
        </div>
      </stacked-list-item>

      <stacked-list-footer>
        <div>
          <router-link :to="{ name: `${_getLocale()}-checkout-basket` }" class="btn-previous">
            <icon-arrow-left />
            <span>{{ __('Zurück') }}</span>
          </router-link>
        </div>
        <div>
          <a href="" @click.prevent="submit()" class="btn-next">
            <span>{{ __('Weiter') }}</span>
            <icon-arrow-right />
          </a>
        </div>
      </stacked-list-footer>
      
    </stacked-list-container>

  </div>
</template>
<script>
import NProgress from 'nprogress';
import Validation from "@/shared/mixins/Validation";
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

  mixins: [Validation, i18n, Helpers],

  data() {
    return { 

      // User data
      user: {
      },

      // Form data
      form: {
        address_uuid: null,
      },

      // Errors
      errors: {
      },

      // Routes
      routes: {

        student: {
          get: '/api/student',
        },
        
        basket: {
          get: '/api/basket',
          update: '/api/basket/add/user',
        }
      },

      // States
      isFetched: true,
      isLoading: false,
      hasAdresses: false,
    }
  },

  mounted() {
    this.fetch();
  },

  methods: {

    fetch() {
      NProgress.start();
      this.isFetched = false;

      // get user
      this.axios.get(`${this.routes.student.get}`).then(response => {
        this.user = response.data;

        // get basket
        this.axios.get(`${this.routes.basket.get}`).then(response => {
          this.basket = response.data;

          // check for recently set invoice addresses
          if (this.basket.invoice_address_uuid) {
            this.hasAdresses = true;
            this.form.address_uuid = this.basket.invoice_address_uuid;
          }

          this.isFetched = true;
          NProgress.done();
        });
      });
    },

    submit() {

      // Validate address selection
      if (this.hasAdresses && this.form.address_uuid == null) {
        this.$toast.open({
          'message': 'Bitte Rechnungsadresse auswählen',
          'type': 'error'
        });
        return;
      }

      NProgress.start();
      this.$store.commit('isLoading', true);
      this.axios.put(`${this.routes.basket.update}`, this.form).then(response => {
        this.$router.push({ name: `${this._getLocale()}-checkout-payment` });
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    toggle() {
      this.hasAdresses = this.hasAdresses ? false : true;
      if (!this.hasAdresses) {
        this.form.address_uuid = null;
      }
    },

  },
}
</script>