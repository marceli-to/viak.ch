<template>
<form @submit.prevent="submit" v-if="isFetched">
  <article-text>

    <template #aside>
      <h1 class="xs:hide">{{ title }}</h1>
      <back-link :route="'content-news'"></back-link>
    </template>

    <template #content>

      <div class="flex justify-end items-center text-xsmall">
        <a href="" :class="[language == 'de' ? 'link-underline' : '', '']" @click.prevent="setLanguage('de')">DE</a>
        <span class="px-1x">/</span>
        <a href="" :class="[language == 'en' ? 'link-underline' : '', '']" @click.prevent="setLanguage('en')">EN</a>
      </div>

      <template v-if="language == 'de'">
        <form-group :label="'Titel'" :required="true" :error="errors.title">
          <input 
            type="text" 
            v-model="data.title.de"
            required 
            @focus="removeError('title')" />
        </form-group>

        <form-group :label="'Text'">
          <tinymce-editor
            :api-key="tinyApiKey"
            :init="tinyConfig"
            v-model="data.text.de"
          ></tinymce-editor>
        </form-group>

        <form-group :label="'Link'">
          <input 
            type="text" 
            v-model="data.link"
            required 
            @focus="removeError('link')" />
        </form-group>

        <form-group class="line-after flex mt-8x">
          <div class="form-group__checkbox">
            <input type="checkbox" id="publish" name="publish" v-model="data.publish">
            <label for="publish">Publizieren</label>
          </div>
        </form-group>

        <collapsible-container>
          <collapsible :expanded="true">
            <template #title>Bild</template>
            <template #content>
              <images 
                :imageRatioW="3" 
                :imageRatioH="4"
                :type="'News'"
                :typeId="data.id"
                :allowRatioSwitch="false"
                :hasTypes="false"
                :images="data.images"
                v-if="$props.type == 'edit'">
              </images>
              <div class="text-small text-danger mt-2x sm:mt-4x" v-else>
                <em>Bilder können erst nach dem Speichern hochgeladen werden...</em>
              </div>
            </template>
          </collapsible>
        </collapsible-container>
      </template>
      <template v-if="language == 'en'">
        <form-group :label="'Titel'">
          <input 
            type="text" 
            v-model="data.title.en" />
        </form-group>

        <form-group :label="'Text'">
          <tinymce-editor
            :api-key="tinyApiKey"
            :init="tinyConfig"
            v-model="data.text.en"
          ></tinymce-editor>
        </form-group>
      </template>

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

      <div class="form-danger-zone is-danger" v-if="$props.type == 'edit'">
        <h2>News löschen</h2>
        <p>Mit dieser Aktion wird das News gelöscht.</p>
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
import ErrorHandling from "@/shared/mixins/ErrorHandling";
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

  mixins: [ErrorHandling, Helpers],

  props: {
    type: String
  },

  data() {
    return {
      
      // Model
      data: {
        title: {
          de: null,
          en: null,
        },
        text: {
          de: null,
          en: null,
        },
        publish: 1,
        images: [],
      },

      language: 'de',

      // Validation
      errors: {
        title: null,
      },

      // Routes
      routes: {
        find: '/api/dashboard/news',
        store: '/api/dashboard/news',
        update: '/api/dashboard/news',
        delete: '/api/dashboard/news',
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
        this.isLoading = false;
        if (redirect) {
          this.$router.push({ name: 'content-news'});
        }
        else {
          this.$router.push({ name: 'content-news-edit', params: { id: response.data.newsId }});
        }
      });
    },

    update() {
      this.isLoading = true;
      this.axios.put(`${this.routes.update}/${this.$route.params.id}`, this.data).then(response => {
        this.$router.push({ name: 'content-news'});
      });
    },

    destroy() {
      this.isLoading = true;
      NProgress.start();
      this.axios.delete(`${this.routes.delete}/${this.data.id}`).then(response => {
        this.$router.push({ name: 'content-news'});
        this.isLoading = false;
        NProgress.done();
      });
    },

    setLanguage(language) {
      this.language = language;
    }
  },

  computed: {
    title() {
      return this.$props.type == 'edit' ? "News bearbeiten" : "News hinzufügen";
    },
  }
};
</script>
