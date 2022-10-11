<template>
<form @submit.prevent="submit" v-if="isFetched">
  <article-text>
    <template #aside>
      <h1 class="xs:hide">{{ title }}</h1>
      <back-link :route="'settings'"></back-link>
    </template>
    <template #content>
      <form-group :label="'Beschreibung'" :required="true" :error="errors.description">
        <input type="text" v-model="data.description.de" required @focus="removeError('description')" />
      </form-group>
      <form-group :label="'Beschreibung (en)'">
        <input type="text" v-model="data.description.en" />
      </form-group>
      <form-group>
        <a href="" @click.prevent="submit()" :class="[isLoading ? 'is-disabled' : '', 'btn-primary']">
          Speichern
        </a>
      </form-group>
      <div class="form-danger-zone is-danger" v-if="$props.type == 'edit'">
        <h2>Level löschen</h2>
        <p>Mit dieser Aktion wird das Level gelöscht.</p>
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
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";
import BackLink from "@/shared/components/ui/misc/BackLink.vue";

export default {

  components: {
    NProgress,
    ArticleText,
    FormGroup,
    BackLink,
  },

  mixins: [ErrorHandling, Helpers],

  props: {
    type: String
  },

  data() {
    return {
      
      // Model
      data: {
        description: {
          de: null,
          en: null,
        }
      },

      // Validation
      errors: {
        description: false,
      },

      // Routes
      routes: {
        find: '/api/dashboard/settings/level',
        store: '/api/dashboard/settings/level',
        update: '/api/dashboard/settings/level',
        delete: '/api/dashboard/settings/level',
      },

      // States
      isFetched: true,
      isLoading: false,

      // Messages
      messages: {
        stored: 'Daten erfasst!',
        updated: 'Daten aktualisiert!',
      },
    };
  },

  created() {
    if (this.$props.type == 'edit') {
      this.fetch();
    }
  },

  methods: {

    fetch() {
      NProgress.start();
      this.isFetched = false;
      this.axios.get(`${this.routes.find}/${this.$route.params.id}`).then(response => {
        this.data = response.data;
        this.isFetched = true;
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
        this.$router.push({ name: 'settings', params: { type: 'levels' } });
        NProgress.done();
        this.isLoading = true;
      });
    },

    update() {
      this.axios.put(`${this.routes.update}/${this.$route.params.id}`, this.data).then(response => {
        this.$router.push({ name: 'settings', params: { type: 'levels' } });
      });
    },

    destroy() {
      this.isLoading = true;
      NProgress.start();
      this.axios.delete(`${this.routes.delete}/${this.data.id}`).then(response => {
        this.$router.push({ name: 'settings', params: { type: 'levels' } });
        this.isLoading = false;
        NProgress.done();
      });
    },
  },

  computed: {
    title() {
      return this.$props.type == 'edit' ? "Level bearbeiten" : "Level hinzufügen";
    },
  }
};
</script>
