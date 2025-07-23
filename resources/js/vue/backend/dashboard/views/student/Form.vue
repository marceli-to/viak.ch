<template>
<form @submit.prevent="submit" v-if="isFetched">
  <article-text>
    <template #aside>
      <h1 class="xs:hide">{{ title }}</h1>
      <back-link :route="'students'"></back-link>
    </template>
    <template #content>
      <form-group 
        :label="'Geschlecht'" 
        :required="true" 
        :error="errors.gender_id"
        v-if="isFetchedSettings">
        <div class="select-wrapper">
          <select v-model="data.gender_id" @change="removeValidationError('gender_id')">
            <option 
              v-for="(option) in settings.genders" 
              :key="option.id" 
              :value="option.id">
              {{option.description.de}}
            </option>
          </select>
        </div>
      </form-group>
      <form-group :label="'Vorname'" :required="true" :error="errors.firstname">
        <input type="text" v-model="data.firstname" required @focus="removeValidationError('firstname')" />
      </form-group>
      <form-group :label="'Name'" :required="true" :error="errors.name">
        <input type="text" v-model="data.name" required @focus="removeValidationError('name')" />
      </form-group>
      <form-group :label="'Telefon'" :required="true" class="span-6" :error="errors.phone">
        <input type="text" v-model="data.phone" required maxlength="30" @focus="removeValidationError('phone')" />
      </form-group>
      <grid class="sm:grid-cols-12">
        <form-group :label="'Strasse'" :required="true" class="span-6" :error="errors.street">
          <input type="text" v-model="data.street" required @focus="removeValidationError('street')" />
        </form-group>
        <form-group :label="'Nr.'" class="span-6">
          <input type="text" v-model="data.street_no" maxlength="5" />
        </form-group>
      </grid>
      <grid class="sm:grid-cols-12">
        <form-group :label="'PLZ'" :required="true" class="span-6" :error="errors.zip">
          <input type="text" v-model="data.zip" required maxlength="10" @focus="removeValidationError('zip')" />
        </form-group>
        <form-group :label="'Ort'" :required="true" class="span-6" :error="errors.city">
          <input type="text" v-model="data.city" required @focus="removeValidationError('city')" />
        </form-group>
      </grid>
      <form-group 
        :label="'Land'" 
        :required="true" 
        :error="errors.country_id" 
        v-if="isFetchedSettings">
        <div class="select-wrapper">
          <select v-model="data.country_id" @change="removeValidationError('country_id')">
            <option 
              v-for="(option) in settings.countries" 
              :key="option.id" 
              :value="option.id">
              {{option.name}}
            </option>
          </select>
        </div>
      </form-group>
      <form-group class="line-after">
        <div class="flex items-center">
          <input type="checkbox" id="subscribe_newsletter" name="subscribe_newsletter" required value="1" v-model="data.subscribe_newsletter">
          <label for="subscribe_newsletter">Newsletter abonnieren</label>
        </div>
      </form-group>

      <template v-if="type == 'create'">
        <collapsible :expanded="true" class="mt-14x">
          <template #title class="mb-3x">
            <div class="mb-3x">Zugangsdaten</div>
          </template>
          <template #content>
            <form-group label="E-Mail" :error="errors.email">
              <input type="email" v-model="data.email" autocomplete="new-email" aria-autocomplete="new-email" @focus="removeValidationError('email')" />
            </form-group>
            <form-group label="E-Mail wiederholen" :error="errors.email_confirmation">
              <input type="email" v-model="data.email_confirmation" autocomplete="new-email" aria-autocomplete="new-email" @focus="removeValidationError('email_confirmation')" />
            </form-group>
            <form-group label="Passwort" :error="errors.password">
              <input type="password" v-model="data.password" required autocomplete="new-password" aria-autocomplete="off" @focus="removeValidationError('password')" />
              <div class="requirements">min. 8 Zeichen</div>
            </form-group>
            <form-group label="Passwort wiederholen" :error="errors.password_confirmation">
              <input type="password" v-model="data.password_confirmation" autocomplete="new-password-confirmation" aria-autocomplete="off" @focus="removeValidationError('password_confirmation')" />
            </form-group>
          </template>
        </collapsible>
      </template>

      <template v-if="type == 'edit'">
        <collapsible :expanded="true" class="mt-14x">
          <template #title class="mb-3x">
            <div class="mb-3x">Rechnungsadressen</div>
          </template>
          <template #content>
            <stacked-list-item 
              v-for="(address, index) in data.invoice_addresses"
              :key="address.uuid"
              :class="[index == 0 ? 'md:mt-3x' : '', '']">
              {{ address.address_str }}
              <router-link :to="{ name: `student-address-edit`, params: { id: data.id, uuid: address.uuid } }" class="icon-edit mt-2x sm:mt-4x">
                <icon-edit />
              </router-link>
            </stacked-list-item>
            <div class="flex justify-start mt-6x">
              <router-link :to="{ name: `student-address-create`, params: { id: data.id } }" class="icon-plus">
                <icon-plus />
              </router-link>
            </div>
          </template>
        </collapsible>
      </template>

      <form-group>
        <a href="" @click.prevent="submit()" :class="[$store.state.isLoading ? 'is-disabled' : '', 'btn-primary']">
          Speichern
        </a>
      </form-group>

      <div class="form-danger-zone is-danger" v-if="$props.type == 'edit'">
        <h2>Student löschen</h2>
        <p>Mit dieser Aktion wird der Student gelöscht.</p>
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
import TinymceEditor from "@tinymce/tinymce-vue";
import tinyConfig from "@/shared/config/tiny.js";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
import StackedListItem from "@/shared/components/ui/layout/StackedListItem.vue";
import IconEdit from "@/shared/components/ui/icons/Edit.vue";
import IconPlus from "@/shared/components/ui/icons/Plus.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";
import FormGroupHeader from "@/shared/components/ui/form/FormGroupHeader.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import Images from "@/shared/modules/images/Index.vue";
import BackLink from "@/shared/components/ui/misc/BackLink.vue";

export default {

  components: {
    NProgress,
    ArticleText,
    Grid,
    GridCol,
    FormGroup,
    FormGroupHeader,
    TinymceEditor,
    Images,
    BackLink,
    CollapsibleContainer,
    Collapsible,
    StackedListItem,
    IconEdit,
    IconPlus,
  },

  mixins: [Validation, Helpers],

  props: {
    type: String
  },

  data() {
    return {
      
      // Model
      data: {
        gender_id: 2,
        country_id: 1,
        subscribe_newsletter: 1,
      },

      // Validation
      errors: {
        firstname: null,
        name: null,
        street: null,
        zip: null,
        city: null,
        email: null,
        email_confirmation: null,
        password: null,
        password_confirmation: null,
        country_id: null,
        gender_id: null,
      },

      // Settings
      settings: {
        genders: [],
        countries: [],
      },

      // Routes
      routes: {
        find: '/api/dashboard/student',
        store: '/api/dashboard/student',
        update: '/api/dashboard/student',
        delete: '/api/dashboard/student',
        settings: '/api/user/settings',
      },

      // States
      isFetched: false,
      isFetchedSettings: false,
      isLoading: false,

      // Messages
      messages: {
        emptyData: 'Es sind noch keine Daten vorhanden...',
        stored: 'Daten erfasst!',
        updated: 'Daten aktualisiert!',
      },

      // Tiny configuration
      tinyConfig: tinyConfig,
      tinyApiKey: 'vuaywur9klvlt3excnrd9xki1a5lj25v18b2j0d0nu5tbwro',
    };
  },

  created() {
    if (this.$props.type == 'edit') {
      this.fetch();
    }
    if (this.$props.type == 'create') {
      this.isFetched = true;
    }
    this.fetchSettings();
  },

  methods: {

    fetch() {
      NProgress.start();
      this.axios.get(`${this.routes.find}/${this.$route.params.id}`).then(response => {
        this.data = response.data;
        console.log(this.data.operating_system);
        this.isFetched = true;
        NProgress.done();
      });
    },

    fetchSettings() {
      this.isFetchedSettings = false;
      NProgress.start();
      this.axios.get(`${this.routes.settings}`).then(response => {
        this.settings.genders = response.data.genders;
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
        this.$router.push({ name: 'students'});
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
        this.$store.commit('isLoading', false); 
        NProgress.done();
      });
    },

    update() {
      NProgress.start();
      this.$store.commit('isLoading', true);
      this.axios.put(`${this.routes.update}/${this.$route.params.id}`, this.data).then(response => {
        this.$router.push({ name: 'students'});
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
        this.$store.commit('isLoading', false); 
        NProgress.done();
      });
    },

    destroy() {
      NProgress.start();
      this.$store.commit('isLoading', true);
      this.axios.delete(`${this.routes.delete}/${this.data.id}`).then(response => {
        this.$router.push({ name: 'students'});
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },
  },

  computed: {
    title() {
      return this.$props.type == 'edit' ? "Student bearbeiten" : "Student hinzufügen";
    },
  }
};
</script>
