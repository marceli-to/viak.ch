<template>
<form @submit.prevent="submit" v-if="isFetched">
  <article-text>

    <template #aside>
      <h1 class="xs:hide">{{ title }}</h1>
      <back-link :route="'courses'"></back-link>
    </template>

    <template #content>
      <div class="flex justify-end items-center text-xsmall">
        <a href="" :class="[language == 'de' ? 'link-underline' : '', '']" @click.prevent="setLanguage('de')">DE</a>
        <span class="px-1x">/</span>
        <a href="" :class="[language == 'en' ? 'link-underline' : '', '']" @click.prevent="setLanguage('en')">EN</a>
      </div>

      <template v-if="language == 'de'">
        <form-group :label="'Nummer'" :required="true" :error="errors.number" v-if="language == 'de'">
          <input 
            type="number" 
            v-model="data.number"
            required 
            @focus="removeValidationError('number')" />
        </form-group>
        <form-group :label="'Titel'" :required="true" :error="errors.title">
          <input 
            type="text" 
            v-model="data.title.de" 
            required 
            @focus="removeValidationError('title')" />        
        </form-group>

        <form-group :label="'Subtitel'" :required="true" :error="errors.subtitle">
          <textarea 
            v-model="data.subtitle.de" 
            class="is-small has-autosize" 
            required 
            @focus="removeValidationError('subtitle')">
          </textarea>
        </form-group>

        <form-group :label="'Kosten'">
          <input type="number" v-model="data.fee" />
        </form-group>

        <form-group :label="'Kurzbeschrieb'" :required="true" :error="errors.short_description">
          <tinymce-editor
            :api-key="tinyApiKey"
            :init="tinyConfig"
            v-model="data.short_description.de"
          ></tinymce-editor>
        </form-group>

        <form-group :label="'Detailbeschrieb'">
          <tinymce-editor
            :api-key="tinyApiKey"
            :init="tinyConfig"
            v-model="data.full_description.de"
          ></tinymce-editor>
        </form-group>

        <form-group :label="'Weitere Informationen'">
          <tinymce-editor
            :api-key="tinyApiKey"
            :init="tinyConfig"
            v-model="data.additional_information.de"
          ></tinymce-editor>
          <tinymce-editor
            :api-key="tinyApiKey"
            :init="tinyConfig"
            v-model="data.additional_information_1.de"
          ></tinymce-editor>
        </form-group>

        <form-group :label="'Kursbeschreibung (PDF)'">
          <tinymce-editor
            :api-key="tinyApiKey"
            :init="tinyConfig"
            v-model="data.summary.de"
          ></tinymce-editor>
        </form-group>

        <collapsible-container>
          <collapsible>
            <template #title>Facts</template>
            <template #content>
              <form-group>
                <tinymce-editor
                :api-key="tinyApiKey"
                :init="tinyConfig"
                v-model="data.facts_column_1.de"
                ></tinymce-editor>
              </form-group>
              <form-group>
                <tinymce-editor
                :api-key="tinyApiKey"
                :init="tinyConfig"
                v-model="data.facts_column_2.de"
                ></tinymce-editor>
              </form-group>
              <form-group>
                <tinymce-editor
                :api-key="tinyApiKey"
                :init="tinyConfig"
                v-model="data.facts_column_3.de"
                ></tinymce-editor>
              </form-group>
            </template>
          </collapsible>
        </collapsible-container>

        <collapsible-container>
          <collapsible :expanded="true" v-if="isFetchedSettings">
            <template #title>Einstellungen</template>
            <template #content>
              <form-group class="line-after flex mt-4x">
                <div class="mr-16x md:mr-20x">
                  <div class="form-group__checkbox">
                    <input type="checkbox" id="online" name="online" :value="1" v-model="data.online">
                    <label for="online">Onlinekurs</label>
                  </div>
                </div>
                <div>
                  <div class="form-group__checkbox">
                    <input type="checkbox" id="publish" name="publish" :value="1" v-model="data.publish">
                    <label for="publish">Publizieren</label>
                  </div>
                </div>
              </form-group>
              <form-group-header :error="errors.category_ids">
                <h3>Kategorien *</h3>
              </form-group-header>
              <form-group class="line-after" :required="true" :error="errors.category_ids">
                <div class="form-group__checkbox" v-for="(category, index) in sorted(settings.categories, 'description.de', 'asc')" :key="index">
                  <input type="checkbox" :id="`category-${category.id}`" :name="`category-${category.id}`" :value="category.id" v-model="data.category_ids">
                  <label :for="`category-${category.id}`">
                    {{category.description.de}}
                  </label>
                </div>
              </form-group>
              <form-group-header :error="errors.language_ids">
                <h3>Sprachen *</h3>
              </form-group-header>
              <form-group class="line-after" :required="true" :error="errors.language_ids">
                <div class="form-group__checkbox" v-for="(language, index) in sorted(settings.languages, 'description.de', 'asc')" :key="index">
                  <input type="checkbox" :id="`language-${language.id}`" :name="`language-${language.id}`" :value="language.id" v-model="data.language_ids">
                  <label :for="`language-${language.id}`">
                    {{language.description.de}}
                  </label>
                </div>
              </form-group>
              <form-group-header :error="errors.level_ids">
                <h3>Levels *</h3>
              </form-group-header>
              <form-group class="line-after" :required="true" :error="errors.level_ids">
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
              <form-group class="line-after">
                <div class="form-group__checkbox" v-for="(software, index) in sorted(settings.software, 'description.de', 'asc')" :key="index">
                  <input type="checkbox" :id="`software-${software.id}`" :name="`software-${software.id}`" :value="software.id" v-model="data.software_ids">
                  <label :for="`software-${software.id}`">
                    {{software.description.de}}
                  </label>
                </div>
              </form-group>
              <form-group-header>
                <h3>Tags</h3>
              </form-group-header>
              <form-group class="line-after grid-cols-12 grid-row-gap-none">
                <div class="form-group__checkbox span-6" v-for="(tag, index) in sorted(settings.tags, 'description.de', 'asc')" :key="index">
                  <input type="checkbox" :id="`tag-${tag.id}`" :name="`tag-${tag.id}`" :value="tag.id" v-model="data.tag_ids">
                  <label :for="`tag-${tag.id}`">
                    {{tag.description.de}}
                  </label>
                </div>
              </form-group>
            </template>
          </collapsible>
          <collapsible>
            <template #title>Bilder</template>
            <template #content>
              <images 
                :imageRatioW="16" 
                :imageRatioH="9"
                :type="'Course'"
                :typeId="data.id"
                :images="data.images"
                v-if="$props.type == 'edit'">
              </images>
              <div class="text-small text-danger mt-2x sm:mt-4x" v-else>
                <em>Bilder können erst nach dem Speichern hochgeladen werden...</em>
              </div>
            </template>
          </collapsible>
          <collapsible>
            <template #title>Videos</template>
            <template #content>
              <videos 
              :courseId="data.id"
              :videos="data.videos"
              v-if="$props.type == 'edit'">
            </videos>
            <div class="text-small text-danger mt-2x sm:mt-4x" v-else>
              <em>Videos können erst nach dem Speichern hinzugefügt werden...</em>
            </div>
            </template>
          </collapsible>
          <collapsible>
            <template #title>Metatags + SEO</template>
            <template #content>
              <form-group :label="'Rezensionen'" class="md:mt-4x">
                <textarea v-model="data.reviews" class="has-autosize"></textarea>
              </form-group>
              <form-group :label="'SEO - Beschreibung'">
                <textarea v-model="data.seo_description.de" class="has-autosize"></textarea>
              </form-group>
              <form-group :label="'SEO - Keywords'">
                <textarea v-model="data.seo_tags.de" class="has-autosize"></textarea>
              </form-group>
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

        <form-group :label="'Subtitel'">
          <textarea 
            v-model="data.subtitle.en" 
            class="is-small has-autosize">
          </textarea>
        </form-group>

        <form-group :label="'Kurzbeschrieb'">
          <tinymce-editor
            :api-key="tinyApiKey"
            :init="tinyConfig"
            v-model="data.short_description.en"
          ></tinymce-editor>
        </form-group>

        <form-group :label="'Detailbeschrieb'">
          <tinymce-editor
            :api-key="tinyApiKey"
            :init="tinyConfig"
            v-model="data.full_description.en"
          ></tinymce-editor>
        </form-group>

        <form-group :label="'Weitere Informationen'">
          <tinymce-editor
            :api-key="tinyApiKey"
            :init="tinyConfig"
            v-model="data.additional_information.en"
          ></tinymce-editor>
          <tinymce-editor
            :api-key="tinyApiKey"
            :init="tinyConfig"
            v-model="data.additional_information_1.en"
          ></tinymce-editor>
        </form-group>

        <form-group :label="'Kursbeschreibung (PDF)'">
          <tinymce-editor
            :api-key="tinyApiKey"
            :init="tinyConfig"
            v-model="data.summary.en"
          ></tinymce-editor>
        </form-group>

        <collapsible-container>
          <collapsible>
            <template #title>Facts</template>
            <template #content>
              <form-group>
                <tinymce-editor
                :api-key="tinyApiKey"
                :init="tinyConfig"
                v-model="data.facts_column_1.en"
                ></tinymce-editor>
              </form-group>
              <form-group>
                <tinymce-editor
                :api-key="tinyApiKey"
                :init="tinyConfig"
                v-model="data.facts_column_2.en"
                ></tinymce-editor>
              </form-group>
              <form-group>
                <tinymce-editor
                :api-key="tinyApiKey"
                :init="tinyConfig"
                v-model="data.facts_column_3.en"
                ></tinymce-editor>
              </form-group>
            </template>
          </collapsible>
        </collapsible-container>

        <collapsible-container>
          <collapsible>
            <template #title>Metatags + SEO</template>
            <template #content>
              <form-group :label="'Rezensionen'" class="md:mt-4x">
                <textarea v-model="data.reviews" class="has-autosize"></textarea>
              </form-group>
              <form-group :label="'SEO - Beschreibung'">
                <textarea v-model="data.seo_description.de" class="has-autosize"></textarea>
              </form-group>
              <form-group :label="'SEO - Keywords'">
                <textarea v-model="data.seo_tags.de" class="has-autosize"></textarea>
              </form-group>
            </template>
          </collapsible>
        </collapsible-container>

      </template>

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
        <h2>Kurs löschen</h2>
        <p>Mit dieser Aktion wird der Kurs inklusive aller Veranstaltungen gelöscht.</p>
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
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";
import FormGroupHeader from "@/shared/components/ui/form/FormGroupHeader.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import Images from "@/shared/modules/images/Index.vue";
import Videos from "@/backend/dashboard/views/course/videos/Index.vue";
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
    Videos,
    BackLink,
    CollapsibleContainer,
    Collapsible
  },

  mixins: [Validation, Helpers],

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
        short_description: {
          de: null,
          en: null
        },
        full_description: {
          de: null,
          en: null
        },
        additional_information: {
          de: null,
          en: null
        },
        additional_information_1: {
          de: null,
          en: null
        },
        summary: {
          de: null,
          en: null
        },
        facts_column_1: {
          de: null,
          en: null
        },
        facts_column_2: {
          de: null,
          en: null
        },
        facts_column_3: {
          de: null,
          en: null
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
        images: [],
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
        delete: '/api/dashboard/course',
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

      // Language
      language: 'de',
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
      this.axios.get(`${this.routes.settings}`).then(response => {
        this.settings = response.data;
        this.isFetchedSettings = true;
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
        if (redirect) {
          this.$router.push({ name: 'courses'});
        }
        else {
          this.$router.push({ name: 'course-edit', params: { id: response.data.courseId }});
        }
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    update() {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.put(`${this.routes.update}/${this.$route.params.id}`, this.data).then(response => {
        this.$router.push({ name: 'courses'});
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    destroy() {
      this.$store.commit('isLoading', true); 
      NProgress.start();
      this.axios.delete(`${this.routes.delete}/${this.data.id}`).then(response => {
        this.$router.push({ name: 'courses'});
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    sorted(data, by, dir){
      return _.orderBy(data, by, dir);
    },

    setLanguage(language) {
      this.language = language;
    }
  },

  computed: {
    title() {
      return this.$props.type == 'edit' ? "Kurs bearbeiten" : "Kurs hinzufügen";
    },
  }
};
</script>
