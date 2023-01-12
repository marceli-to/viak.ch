<template>
<form @submit.prevent="submit" v-if="isFetched">
  <article-text>
    <template #aside>
      <h1 class="xs:hide">{{ title }}</h1>
      <back-link :route="`${_getLocale()}-student-profile`"></back-link>
    </template>
    <template #content>

      <grid class="sm:grid-cols-12">
        <form-group :label="__('Vorname')" class="sm:span-6" :error="errors.firstname">
          <input type="text" v-model="data.firstname" @focus="removeValidationError('firstname')" />
        </form-group>
        <form-group :label="__('Name')" class="sm:span-6" :error="errors.name">
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
        <a href="" @click.prevent="submit()" :class="[$store.state.isLoading ? 'is-disabled' : '', 'btn-primary']">
          Speichern
        </a>
      </form-group>
      <div class="form-danger-zone is-danger" v-if="$props.type == 'edit'">
        <h2>Adresse löschen</h2>
        <p>Mit dieser Aktion wird diese Adresse gelöscht.</p>
        <a href="" class="btn-danger" @click.prevent="confirmDestroy()">Löschen</a>
      </div>
    </template>
  </article-text>
  <notification ref="notification">
    <template #actions>
      <a href="javascript:;" @click="destroy()" class="btn-primary">Bestätigen</a>
      <a href="javascript:;" @click="$refs.notification.hide()" class="btn-secondary">Abbrechen</a>
    </template>
  </notification>
</form>
</template>
<script>
import NProgress from 'nprogress';
import Validation from "@/shared/mixins/Validation";
import Helpers from "@/shared/mixins/Helpers";
import i18n from "@/shared/mixins/i18n";
import { TheMask } from "vue-the-mask";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import BackLink from "@/shared/components/ui/misc/BackLink.vue";

export default {

  components: {
    NProgress,
    ArticleText,
    Grid,
    GridCol,
    FormGroup,
    BackLink,
    CollapsibleContainer,
    Collapsible,
    TheMask,
    BackLink
  },

  mixins: [Validation, Helpers, i18n],

  props: {
    type: String
  },

  data() {
    return {
      
      // Model
      data: {

      },

      settings: {

      },

      // Validation
      errors: {

      },

      // Routes
      routes: {
        find: '/api/student/address',
        store: '/api/student/address',
        update: '/api/student/address',
        delete: '/api/student/address',
        settings: '/api/user/settings',
      },

      // States
      isFetched: true,
      isFetchedSettings: false,
      isLoading: false,
    };
  },

  created() {
    if (this.$props.type == 'edit') {
      this.fetch();
    }
    this.fetchSettings();
  },

  methods: {

    fetch() {
      NProgress.start();
      this.isFetched = false;
      this.axios.get(`${this.routes.find}/${this.$route.params.uuid}`).then(response => {
        this.data = response.data;
        this.isFetched = true;
        NProgress.done();
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

    submit() {
      if (this.$props.type == 'edit') {
        this.update();
      }

      if (this.$props.type == 'create') {
        this.store();
      }
    },

    store() {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.post(this.routes.store, this.data).then(response => {
        this.$router.push({ name: `${this._getLocale()}-student-profile`});
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    update() {
      NProgress.start();
      this.$store.commit('isLoading', true);
      this.axios.put(`${this.routes.update}/${this.$route.params.uuid}`, this.data).then(response => {
        this.$router.push({ name: `${this._getLocale()}-student-profile`});
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    destroy() {
      NProgress.start();
      this.$store.commit('isLoading', true);
      this.axios.delete(`${this.routes.delete}/${this.data.uuid}`).then(response => {
        this.$router.push({ name: `${this._getLocale()}-student-profile`});
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },
  },

  computed: {
    title() {
      return this.$props.type == 'edit' ? `${this.__('Adresse bearbeiten')}` : `${this.__('Adresse hinzufügen')}`;
    },
  }
};
</script>
