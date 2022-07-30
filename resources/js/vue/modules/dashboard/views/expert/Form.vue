<template>
<form @submit.prevent="submit" v-if="isFetched">
  <article-text>
    <template #aside>
      <h1 class="xs:hide">{{ title }}</h1>
      <div class="sm:mt-6x">
        <router-link :to="{ name: 'experts' }" class="icon-arrow-right:below is-small">
          <span>Zurück</span>
          <icon-arrow-right :size="'sm'" />
        </router-link>
      </div>
    </template>
    <template #content>
      <form-group 
        :label="'Geschlecht'" 
        :required="true" 
        :error="errors.gender_id"
        v-if="isFetchedSettings">
        <div class="select-wrapper">
          <select v-model="data.gender_id" @change="removeError('gender_id')">
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
        <input type="text" v-model="data.firstname" required @focus="removeError('firstname')" />
      </form-group>
      <form-group :label="'Name'" :required="true" :error="errors.name">
        <input type="text" v-model="data.name" required @focus="removeError('name')" />
      </form-group>
      <form-group :label="'E-Mail'" :required="true" :error="errors.email">
        <input type="email" v-model="data.email" required autocomplete="false" aria-autocomplete="false" @focus="removeError('email')" />
      </form-group>
      <form-group :label="'Telefon'">
        <input type="text" v-model="data.phone" maxlength="30" />
      </form-group>
      <grid class="sm:grid-cols-12">
        <form-group :label="'Strasse'" :required="true" class="span-6" :error="errors.street">
          <input type="text" v-model="data.street" required @focus="removeError('street')" />
        </form-group>
        <form-group :label="'Nr.'" class="span-6">
          <input type="text" v-model="data.street_no" maxlength="5" />
        </form-group>
      </grid>
      <grid class="sm:grid-cols-12">
        <form-group :label="'PLZ'" :required="true" class="span-6" :error="errors.zip">
          <input type="text" v-model="data.zip" required maxlength="10" @focus="removeError('zip')" />
        </form-group>
        <form-group :label="'Ort'" :required="true" class="span-6" :error="errors.city">
          <input type="text" v-model="data.city" required @focus="removeError('city')" />
        </form-group>
      </grid>
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
      <collapsible class="">
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
        <template #title>Biographie</template>
        <template #content>
          <form-group :error="errors.expert_bio">
            <tinymce-editor
              :api-key="tinyApiKey"
              :init="tinyConfig"
              v-model="data.expert_bio"
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
          <a href="" @click.prevent="submit(true)" :class="[isLoading ? 'is-disabled' : '', 'btn-primary xs:mb-3x sm:span-6']">
            Speichern und schliessen
          </a>
          <a href="" @click.prevent="submit(false)" :class="[isLoading ? 'is-disabled' : '', 'btn-primary sm:span-6']">
            Speichern
          </a>
        </grid>
        <a href="" @click.prevent="submit(false)" :class="[isLoading ? 'is-disabled' : '', 'btn-primary sm:span-6']" v-else>
          Speichern
        </a>
      </form-group>
      <div class="form-danger-zone" v-if="$props.type == 'edit'">
        <h2>Experte löschen</h2>
        <p>Mit dieser Aktion wird der Experte gelöscht und aus den Veranstaltungen entfernt.</p>
        <a href="" class="btn-danger" @click.prevent="destroy()">Löschen</a>
      </div>
    </template>
  </article-text>
</form>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
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
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";

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
    IconArrowRight,
    CollapsibleContainer,
    Collapsible
  },

  mixins: [ErrorHandling],

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
      },

      // Routes
      routes: {
        find: '/api/dashboard/expert',
        store: '/api/dashboard/expert',
        update: '/api/dashboard/expert',
        delete: '/api/dashboard/expert',
        settings: '/api/genders',
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
        this.isFetched = true;
        NProgress.done();
      });
    },

    fetchSettings() {
      this.isFetchedSettings = false;
      NProgress.start();
      this.axios.get(`${this.routes.settings}`).then(response => {
        this.settings.genders = response.data;
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
      this.isLoading = true;
      this.axios.post(this.routes.store, this.data).then(response => {
        NProgress.done();
        this.isLoading = true;
        if (redirect) {
          this.$router.push({ name: 'experts'});
        }
        else {
          this.$router.push({ name: 'expert-edit', params: { id: response.data.userId }});
        }
      });
    },

    update() {
      this.axios.put(`${this.routes.update}/${this.data.id}`, this.data).then(response => {
        this.$router.push({ name: 'experts'});
      });
    },

    destroy() {
      if (confirm('Sicher?')) {
        this.isLoading = true;
        NProgress.start();
        this.axios.delete(`${this.routes.delete}/${this.data.id}`).then(response => {
          this.$router.push({ name: 'experts'});
          this.isLoading = false;
          NProgress.done();
        });
      }
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
