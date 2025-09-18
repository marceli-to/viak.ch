<template>
<form @submit.prevent="submit" v-if="isFetched">
  <article-text>
    <template #aside>
      <h1 class="xs:hide">{{ title }}</h1>
      <back-link :route="'experts'"></back-link>
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
      <form-group :label="'Firma'">
        <input type="text" v-model="data.company" />
      </form-group>
      <form-group :label="'E-Mail'" :required="true" :error="errors.email">
        <input type="email" v-model="data.email" required autocomplete="off" aria-autocomplete="off" @focus="removeValidationError('email')" />
      </form-group>
      <form-group :label="'Telefon'">
        <input type="text" v-model="data.phone" maxlength="30" />
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
      <form-group :label="'Land'" :required="true" :error="errors.country_id">
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
      <grid class="sm:grid-cols-12">
        <form-group :label="'Experte anzeigen?'" class="span-6">
            <div class="form-group__checkbox">
              <input type="checkbox" id="visible" name="visible" :value="1" v-model="data.visible">
              <label for="visible">Ja</label>
            </div>
        </form-group>
        <form-group :label="'Experte aktiv?'" class="span-6">
          <div class="form-group__checkbox">
            <input type="checkbox" id="publish" name="publish" :value="1" v-model="data.publish">
            <label for="publish">Ja</label>
          </div>
        </form-group>
      </grid>
      
      <collapsible :expanded="true">
        <template #title>
          <template v-if="errors.roles">
            <div class="text-danger">{{ errors.roles }}</div> 
          </template>
          <template v-else>Benutzer-Rollen</template>
        </template>
        <template #content>

          <grid class="sm:grid-cols-12 pt-4x">
            <form-group 
              v-for="role in settings.roles" :key="role.id"
              class="span-3">
              <div class="form-group__checkbox">
                <input 
                  type="checkbox" 
                  :id="`role-${role.id}`" 
                  name="roles[]" 
                  :value="role.id" 
                  v-model="data.roles"
                  @change="removeValidationError('roles')">
                <label :for="`role-${role.id}`">{{ role.name }}</label>
              </div>
            </form-group>
          </grid>

        </template>
      </collapsible>

      <collapsible>
        <template #title>Über</template>
        <template #content>
          <form-group :label="'Titel'" class="mt-2x sm:mt-4x">
            <input type="text" v-model="data.expert_title" />
          </form-group>
          <form-group :label="'Beschreibung'">
            <tinymce-editor
              :api-key="tinyApiKey"
              :init="tinyConfig"
              v-model="data.expert_description"
            ></tinymce-editor>
          </form-group>
        </template>
      </collapsible>

      <collapsible>
        <template #title>Profilbild</template>
        <template #content>
          <images 
            :imageRatioW="16" 
            :imageRatioH="9"
            :type="'User'"
            :typeId="data.id"
            :images="data.images"
             v-if="$props.type == 'edit'">
          </images>
          <div class="text-small text-danger mt-2x sm:mt-4x" v-else>
            <em>Bilder können erst nach dem Speichern hochgeladen werden...</em>
          </div>
        </template>
      </collapsible>

      <form-group>
        <grid class="sm:grid-cols-12" v-if="$props.type == 'create'">
          <a href="" @click.prevent="submit(true)" :class="[$store.state.isLoading ? 'is-disabled' : '', 'btn-primary xs:mb-3x sm:span-6']">
            Speichern und schliessen
          </a>
          <a href="" @click.prevent="submit(false)" :class="[$store.state.isLoading ? 'is-disabled' : '', 'btn-primary sm:span-6']">
            Speichern
          </a>
        </grid>
        <a href="" @click.prevent="submit(false)" :class="[$store.state.isLoading ? 'is-disabled' : '', 'btn-primary sm:span-6']" v-else>
          Speichern
        </a>
      </form-group>
      <div class="form-danger-zone is-danger" v-if="$props.type == 'edit'">
        <h2>Experte löschen</h2>
        <p>Mit dieser Aktion wird der Experte gelöscht und aus den Veranstaltungen entfernt.</p>
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
import i18n from "@/shared/mixins/i18n";
import Helpers from "@/shared/mixins/Helpers";
import TinymceEditor from "@tinymce/tinymce-vue";
import tinyConfig from "@/shared/config/tiny.js";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
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
    Collapsible
  },

  mixins: [Validation, Helpers, i18n],

  props: {
    type: String
  },

  data() {
    return {
      
      // Model
      data: {
        gender_id: 2,
        publish: 0,
        visisble: 0,
        roles: [2],
        subscribe_newsletter: 0,
      },

      // Validation
      errors: {
        firstname: null,
        name: null,
        street: null,
        zip: null,
        city: null,
        email: null,
        gender_id: null,
      },

      // Settings
      settings: {
        genders: [],
        countries: [],
        roles: [],
      },

      // Routes
      routes: {
        find: '/api/dashboard/expert',
        store: '/api/dashboard/expert',
        update: '/api/dashboard/expert',
        delete: '/api/dashboard/expert',
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
        this.data.roles = response.data.roles.map(i => i['id']);
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
        this.settings.roles = response.data.roles;
        this.isFetchedSettings = true;
        NProgress.done();
      });
    },

    submit(redirect) {
      if (this.$props.type == 'edit') {
        this.update();
      }

      if (this.$props.type == 'create') {
        this.store(redirect);
      }
    },

    store(redirect) {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.post(this.routes.store, this.data).then(response => {
        NProgress.done();
        this.$store.commit('isLoading', true); 
        if (redirect) {
          this.$router.push({ name: 'experts'});
        }
        else {
          this.$router.push({ name: 'expert-edit', params: { id: response.data.userId }});
        }
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    update() {

      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.put(`${this.routes.update}/${this.data.id}`, this.data).then(response => {
        this.$router.push({ name: 'experts'});
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    destroy() {
      NProgress.start();
      this.$store.commit('isLoading', true);
      this.axios.delete(`${this.routes.delete}/${this.data.id}`).then(response => {
        this.$router.push({ name: 'experts'});
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });  
    },

    sorted(data, by, dir){
      return _.orderBy(data, by, dir);
    }
  },

  computed: {
    title() {
      return this.$props.type == 'edit' ? "Experte bearbeiten" : "Experte hinzufügen";
    },
  }
};
</script>
