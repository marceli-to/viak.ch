<template>
<form @submit.prevent="submit" v-if="isFetched">
  <article-text>
    <template #aside>
      <h1 class="xs:hide">{{ title }}</h1>
      <div class="sm:mt-6x">
        <router-link :to="{ name: 'students' }" class="icon-arrow-right:below is-small">
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
      <form-group class="has-underline" :error="errors.invoice_address">
        <div class="flex items-center">
          <input type="checkbox" id="has_invoice_address" name="has_invoice_address" required value="1" v-model="data.has_invoice_address">
          <label for="has_invoice_address">
            <em v-if="errors.invoice_address">Rechnungsadresse (abweichend) wird benötigt</em>
            <em v-else>Rechnungsadresse (abweichend)</em>
          </label>
        </div>
        <textarea 
          v-model="data.invoice_address" 
          :placeholder="'Rechnungsadresse'" 
          class="is-plain mt-2x sm:mt-4x autosize" 
          v-if="data.has_invoice_address">
        </textarea>
      </form-group>
      <form-group>
        <a href="" @click.prevent="submit()" :class="[isLoading ? 'is-disabled' : '', 'btn-primary']">
          Speichern
        </a>
      </form-group>
      <div class="form-danger-zone" v-if="$props.type == 'edit'">
        <h2>Student löschen</h2>
        <p>Mit dieser Aktion wird der Student gelöscht.</p>
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
      },

      // Validation
      errors: {
        firstname: null,
        name: null,
        street: null,
        zip: null,
        city: null,
        email: null,
        password: null,
        invoice_address: null,
        gender_id: null,
      },

      // Settings
      settings: {
        genders: [],
      },

      // Routes
      routes: {
        find: '/api/dashboard/student',
        store: '/api/dashboard/student',
        update: '/api/dashboard/student',
        delete: '/api/dashboard/student',
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
      this.isLoading = true;
      this.axios.post(this.routes.store, this.data).then(response => {
        this.$router.push({ name: 'students'});
        NProgress.done();
        this.isLoading = true;
      });
    },

    update() {
      this.axios.put(`${this.routes.update}/${this.$route.params.id}`, this.data).then(response => {
        this.$router.push({ name: 'students'});
      });
    },

    destroy() {
      if (confirm('Sicher?')) {
        this.isLoading = true;
        NProgress.start();
        this.axios.delete(`${this.routes.delete}/${this.data.id}`).then(response => {
          this.$router.push({ name: 'students'});
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
      return this.$props.type == 'edit' ? "Student bearbeiten" : "Student hinzufügen";
    },
  }
};
</script>
