<template>
  <div :class="[isOpen ? 'is-visible' : '', 'lightbox']" v-if="isOpen">
    <div class="lightbox-widget">
      <div class="lightbox-overflow">
        <header class="flex justify-between">
          <h1>{{ __('Rechnungsadresse erstellen') }}</h1>
          <a href="javascript:;" class="feather-icon btn-close" @click.prevent="hide()">
            <x-icon size="24"></x-icon>
          </a>
        </header>
        <div class="mt-6x lg:mt-12x">
          <grid class="sm:grid-cols-12">
            <form-group :label="__('Vorname')" class="sm:span-6" :error="errors.firstname">
              <input type="text" v-model="data.firstname" @focus="removeValidationError('firstname')" />
            </form-group>
            <form-group :label="__('Nachname')" class="sm:span-6" :error="errors.name">
              <input type="text" v-model="data.name" @focus="removeValidationError('name')" />
            </form-group>
          </grid>
          <form-group :label="__('Firma')" :error="errors.company">
            <input type="text" v-model="data.company" @focus="removeValidationError('company')" />
          </form-group>
          <grid class="sm:grid-cols-12">
            <form-group :label="__('Strasse')" :required="true" class="span-6" :error="errors.street">
              <input type="text" v-model="data.street" required @focus="removeValidationError('street')" />
            </form-group>
            <form-group :label="__('Nr.')" class="span-6">
              <input type="text" v-model="data.street_no" maxlength="5" />
            </form-group>
          </grid>
          <grid class="sm:grid-cols-12">
            <form-group :label="__('PLZ')" :required="true" class="span-6" :error="errors.zip">
              <input type="text" v-model="data.zip" required maxlength="10" @focus="removeValidationError('zip')" />
            </form-group>
            <form-group :label="__('Ort')" :required="true" class="span-6" :error="errors.city">
              <input type="text" v-model="data.city" required @focus="removeValidationError('city')" />
            </form-group>
          </grid>
          <form-group :label="__('Land')" :required="true" v-if="isFetchedSettings">
            <div class="select-wrapper">
              <select v-model="data.country_id">
                <option 
                  v-for="(option) in settings.countries" 
                  :key="option.id" 
                  :value="option.id">
                  {{option.name}}
                </option>
              </select>
            </div>
          </form-group>
          <form-group>
            <a href="" @click.prevent="store()" :class="[$store.state.isLoading ? 'is-disabled' : '', 'btn-primary']">
              Speichern
            </a>
          </form-group>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { PlusIcon, XIcon } from 'vue-feather-icons';
import NProgress from 'nprogress';
import i18n from "@/shared/mixins/i18n";
import Validation from "@/shared/mixins/Validation";
import Helpers from "@/shared/mixins/Helpers";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";

export default {

  components: {
    NProgress,
    PlusIcon,
    XIcon,
    Grid,
    GridCol,
    FormGroup
  },

  mixins: [i18n, Helpers, Validation],

  data() {
    return {
      data: {
      },

      settings: {
      },

      errors: {
      },

      // Routes
      routes: {
        store: '/api/student/address',
        settings: '/api/user/settings',
      },

      // States
      isFetched: false,
      isFetchedSettings: false,
      isOpen: false,
    }
  },

  created() {
    const onEscape = (e) => {
      if (this.isOpen && e.keyCode === 27) {
        this.hide();
      }
    }
    document.addEventListener('keydown', onEscape);
  },

  mounted() {
    this.fetchSettings();
  },

  methods: {

    store() {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.post(this.routes.store, this.data).then(response => {
        this.$store.commit('isLoading', false); 
        this.hide();
        NProgress.done();
        this.$emit('addressCreated', response.data);
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    fetchSettings() {
      this.isFetchedSettings = false;
      NProgress.start();
      this.axios.get(`${this.routes.settings}`).then(response => {
        this.settings.countries = response.data.countries;
        this.isFetchedSettings = true;
        NProgress.done();
      });
    },

    show(item) {
      this.item = item;
      this.isOpen = true;
    },

    hide() {
      this.item = null;
      this.isOpen = false;
    }
  }
}
</script>