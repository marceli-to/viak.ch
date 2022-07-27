<template>
<form @submit.prevent="submit" v-if="isLoaded">
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
      <form-group :label="'Titel'" :required="true" :error="errors.title.de">
        <input 
          type="text" 
          v-model="data.title.de" 
          required 
          @focus="removeError('title.de')" />
      </form-group>
      <form-group :label="'Subtitel'" :required="true" :error="errors.subtitle.de">
        <textarea 
          v-model="data.subtitle.de" 
          class="is-small" 
          required 
          @focus="removeError('subtitle.de')">
        </textarea>
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
        <collapsible :expanded="true">
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
      },

      // Validation
      errors: {
        number: false,
        title: {
          de: false
        },
        subtitle: {
          de: false,
        }
      },

      // Routes
      routes: {
        find: '/api/dashboard/course',
        store: '/api/dashboard/course',
        update: '/api/dashboard/course',
      },

      // States
      isLoaded: false,

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
  },

  methods: {

    fetch() {
      NProgress.start();
      this.axios.get(`${this.routes.find}/${this.$route.params.id}`).then(response => {
        this.data = response.data;
        this.isLoaded = true;
        NProgress.done();
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
      this.axios.post(this.routes.store, this.data).then(response => {
        this.$router.push({ name: "courses"});
      });
    },

    update() {
      this.axios.put(`${this.routes.update}/${this.$route.params.id}`, this.data).then(response => {
        this.$router.push({ name: "courses"});
      });
    },
  },

  computed: {
    title() {
      return this.$props.type == "edit" 
        ? "Kurs bearbeiten" 
        : "Kurs hinzufügen";
    }
  }
};
</script>
