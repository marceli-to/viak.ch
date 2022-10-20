<template>
<form @submit.prevent="submit" v-if="isFetched">
  <article-text>

    <template #aside>
      <h1 class="xs:hide">{{ title }}</h1>
      <back-link :route="'team-members'"></back-link>
    </template>

    <template #content>
      <form-group :label="'Vorname'" :required="true" :error="errors.firstname">
        <input 
          type="text" 
          v-model="data.firstname"
          required 
          @focus="removeError('firstname')" />
      </form-group>
      <form-group :label="'Name'" :required="true" :error="errors.name">
        <input 
          type="text" 
          v-model="data.name"
          required 
          @focus="removeError('name')" />
      </form-group>

      <form-group :label="'Titel'">
        <textarea v-model="data.title.de" class="is-large"></textarea>
      </form-group>

      <form-group :label="'Info'">
        <tinymce-editor
          :api-key="tinyApiKey"
          :init="tinyConfig"
          v-model="data.info.de"
        ></tinymce-editor>
      </form-group>

      <form-group class="line-after line-before flex mt-8x">
        <div class="form-group__checkbox">
          <input type="checkbox" id="publish" name="publish" v-model="data.publish">
          <label for="publish">Publizieren</label>
        </div>
      </form-group>

      <collapsible-container>
        <collapsible>
          <template #title>Bilder</template>
          <template #content>
            <images 
              :imageRatioW="16" 
              :imageRatioH="9"
              :type="'TeamMember'"
              :typeId="data.id"
              :images="data.images"
              v-if="$props.type == 'edit'">
            </images>
            <div class="text-small text-danger mt-2x sm:mt-4x" v-else>
              <em>Bilder können erst nach dem Speichern hochgeladen werden...</em>
            </div>
          </template>
        </collapsible>
      </collapsible-container>

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
        <h2>Team-Mitglied löschen</h2>
        <p>Mit dieser Aktion wird das Team-Mitglied gelöscht.</p>
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
        firstname: null,
        name: null,
        title: {
          de: null,
          en: null,
        },
        info: {
          de: null,
          en: null,
        },
        publish: 0,
        images: [],
      },

      // Validation
      errors: {
        firstname: null,
        name: null,
      },

      // Settings
      settings: {

      },

      // Routes
      routes: {
        find: '/api/dashboard/team-member',
        store: '/api/dashboard/team-member',
        update: '/api/dashboard/team-member',
        delete: '/api/dashboard/team-member',
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
          this.$router.push({ name: 'team-members'});
        }
        else {
          this.$router.push({ name: 'team-member-edit', params: { id: response.data.teamMemberId }});
        }
      });
    },

    update() {
      this.isLoading = true;
      this.axios.put(`${this.routes.update}/${this.$route.params.id}`, this.data).then(response => {
        this.$router.push({ name: 'team-members'});
      });
    },

    destroy() {
      this.isLoading = true;
      NProgress.start();
      this.axios.delete(`${this.routes.delete}/${this.data.id}`).then(response => {
        this.$router.push({ name: 'team-members'});
        this.isLoading = false;
        NProgress.done();
      });
    },

    sorted(data, by, dir){
      return _.orderBy(data, by, dir);
    }
  },

  computed: {
    title() {
      return this.$props.type == 'edit' ? "Team-Mitglied bearbeiten" : "Team-Mitglied hinzufügen";
    },
  }
};
</script>
