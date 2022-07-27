<template>
<form @submit.prevent="submit" v-if="isFetched">
  <article-text>
    <template #aside>
      <h1 class="xs:hide">{{ title }}</h1>
      <div class="sm:mt-6x">
        <router-link :to="{ name: 'courses' }" class="icon-arrow-right:below is-small">
          <span>Zurück</span>
          <icon-arrow-right :size="'sm'" />
        </router-link>
      </div>
    </template>
    <template #content>
      <form-group :label="'Nummer'" :required="true" :error="errors.number">
        <input 
          type="text" 
          v-model="data.number"
          required 
          @focus="removeError('number')" />
      </form-group>
      <form-group :label="'Titel'" :required="true" :error="errors.title">
        <input 
          type="text" 
          v-model="data.title.de" 
          required 
          @focus="removeError('title.de')" />
      </form-group>
      <form-group :label="'Subtitel'" :required="true" :error="errors.subtitle">
        <textarea 
          v-model="data.subtitle.de" 
          class="is-small" 
          required 
          @focus="removeError('subtitle.de')">
        </textarea>
      </form-group>
      <form-group :label="'Kosten'" :required="true" :error="errors.fee">
        <input 
          type="text" 
          v-model="data.fee" 
          required 
          @focus="removeError('fee')" />
      </form-group>
      <form-group :label="'Beschreibung'">
        <tinymce-editor
          :api-key="tinyApiKey"
          :init="tinyConfig"
          v-model="data.text.de"
        ></tinymce-editor>
      </form-group>

    </template>
    <template #contentWide>
      <collapsible-container>
        <collapsible :expanded="true" v-if="isFetchedSettings">
          <template #title>Einstellungen</template>
          <template #content>
            <form-group class="has-underline flex mt-4x">
              <div class="mr-16x md:mr-20x">
                <div class="form-group__checkbox">
                  <input type="checkbox" id="online" name="online" :value="1" v-model="data.online">
                  <label for="online">Online</label>
                </div>
              </div>
              <div>
                <div class="form-group__checkbox">
                  <input type="checkbox" id="publish" name="publish" :value="1" v-model="data.publish">
                  <label for="publish">Publizieren</label>
                </div>
              </div>
            </form-group>
            <form-group-header>
              <h3>Kategorien *</h3>
            </form-group-header>
            <form-group class="has-underline" :required="true" :error="errors.category_ids">
              <div class="form-group__checkbox" v-for="(category, index) in sorted(settings.categories, 'description.de', 'asc')" :key="index">
                <input type="checkbox" :id="`category-${category.id}`" :name="`category-${category.id}`" :value="category.id" v-model="data.category_ids">
                <label :for="`category-${category.id}`">
                  {{category.description.de}}
                </label>
              </div>
            </form-group>
            <form-group-header>
              <h3>Sprachen *</h3>
            </form-group-header>
            <form-group class="has-underline" :required="true" :error="errors.language_ids">
              <div class="form-group__checkbox" v-for="(language, index) in sorted(settings.languages, 'description.de', 'asc')" :key="index">
                <input type="checkbox" :id="`language-${language.id}`" :name="`language-${language.id}`" :value="language.id" v-model="data.language_ids">
                <label :for="`language-${language.id}`">
                  {{language.description.de}}
                </label>
              </div>
            </form-group>
            <form-group-header>
              <h3>Levels *</h3>
            </form-group-header>
            <form-group class="has-underline" :required="true" :error="errors.level_ids">
              <div class="form-group__checkbox" v-for="(level, index) in sorted(settings.levels, 'description.de', 'asc')" :key="index">
                <input type="checkbox" :id="`level-${level.id}`" :name="`level-${level.id}`" :value="level.id" v-model="data.level_ids">
                <label :for="`level-${level.id}`">
                  {{level.description.de}}
                </label>
              </div>
            </form-group>
            <form-group-header>
              <h3>Software</h3>
            </form-group-header>
            <form-group class="has-underline">
              <div class="form-group__checkbox" v-for="(software, index) in sorted(settings.softwares, 'description.de', 'asc')" :key="index">
                <input type="checkbox" :id="`software-${software.id}`" :name="`software-${software.id}`" :value="software.id" v-model="data.software_ids">
                <label :for="`software-${software.id}`">
                  {{software.description.de}}
                </label>
              </div>
            </form-group>
            <form-group-header>
              <h3>Tags</h3>
            </form-group-header>
            <form-group class="has-underline">
              <div class="form-group__checkbox" v-for="(tag, index) in sorted(settings.tags, 'description.de', 'asc')" :key="index">
                <input type="checkbox" :id="`tag-${tag.id}`" :name="`tag-${tag.id}`" :value="tag.id" v-model="data.tag_ids">
                <label :for="`tag-${tag.id}`">
                  {{tag.description.de}}
                </label>
              </div>
            </form-group>
          </template>
        </collapsible>
        <collapsible>
          <template #title>Metatags + SEO</template>
          <template #content>
            <form-group :label="'Reviews'" class="md:mt-4x">
              <textarea v-model="data.reviews"></textarea>
            </form-group>
            <form-group :label="'SEO - Beschreibung'">
              <textarea v-model="data.seo_description.de"></textarea>
            </form-group>
            <form-group :label="'SEO - Keywords'">
              <textarea v-model="data.seo_tags.de"></textarea>
            </form-group>
          </template>
        </collapsible>
      </collapsible-container>
      <form-group>
        <a href="" @click.prevent="submit()" :class="[isLoading ? 'is-disabled' : '', 'btn-primary']">
          Speichern
        </a>
      </form-group>
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
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";
import FormGroupHeader from "@/shared/components/ui/form/FormGroupHeader.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";

export default {
  components: {
    NProgress,
    ArticleText,
    FormGroup,
    FormGroupHeader,
    TinymceEditor,
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
        number: null,
        title: {
          de: null,
          en: null,
        },
        title: {
          de: null,
          en: null,
        },
        subtitle: {
          de: null,
          en: null,
        },
        seo_description: {
          de: null,
          en: null,
        },
        seo_tags: {
          de: null,
          en: null,
        },
        category_ids: [],
        language_ids: [],
        level_ids: [],
        software_ids: [],
        tag_ids: [],
        fee: null,
        online: 0,
        publish: 0,
      },

      // Validation
      errors: {
        number: null,
        title: null,
        subtitle: null,
        fee: null,
        category_ids: null,
      },

      // Settings
      settings: {

      },

      // Routes
      routes: {
        find: '/api/dashboard/course',
        store: '/api/dashboard/course',
        update: '/api/dashboard/course',
        settings: '/api/dashboard/course-settings',
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
    if (this.$props.type == "edit") {
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
      this.axios.get(`${this.routes.settings}`).then(response => {
        this.settings = response.data;
        this.isFetchedSettings = true;
      });
    },


    submit() {
      if (this.$props.type == "edit") {
        this.update();
      }

      if (this.$props.type == "create") {
        this.store();
      }
    },

    store() {
      NProgress.start();
      this.isLoading = true;
      this.axios.post(this.routes.store, this.data).then(response => {
        //this.$router.push({ name: "courses"});
        NProgress.done();
        this.isLoading = true;
      });
    },

    update() {
      this.axios.put(`${this.routes.update}/${this.$route.params.id}`, this.data).then(response => {
        this.$router.push({ name: "courses"});
      });
    },

    sorted(data, by, dir){
      return _.orderBy(data, by, dir);
    }
  },

  computed: {
    title() {
      return this.$props.type == "edit" ? "Kurs bearbeiten" : "Kurs hinzufügen";
    },
  }
};
</script>
