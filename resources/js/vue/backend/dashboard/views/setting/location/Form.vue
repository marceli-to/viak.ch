<template>
<form @submit.prevent="submit" v-if="isFetched">
  <article-text>
    <template #aside>
      <h1 class="xs:hide">{{ title }}</h1>
      <back-link :route="'settings'"></back-link>
    </template>
    <template #content>
      <form-group :label="'Beschreibung'" :required="true" :error="errors.description">
        <input type="text" v-model="data.description.de" required @focus="removeValidationError('description')" />
      </form-group>
      <form-group :label="'Beschreibung (en)'">
        <input type="text" v-model="data.description.en" />
      </form-group>
      <form-group :label="'Adresse'" :required="true" :error="errors.address">
        <textarea v-model="data.address.de" required @focus="removeValidationError('address')"></textarea>
      </form-group>
      <form-group :label="'Adresse (en)'">
        <textarea v-model="data.address.en"></textarea>
      </form-group>
      <form-group :label="'Google Map URI'">
        <input type="text" v-model="data.map" />
      </form-group>
      <form-group>
        <a href="" @click.prevent="submit()" :class="[$store.state.isLoading ? 'btn-secondary is-disabled' : '', 'btn-primary']">
          Speichern
        </a>
      </form-group>
      <div class="form-danger-zone is-danger" v-if="$props.type == 'edit'">
        <h2>Location löschen</h2>
        <p>Mit dieser Aktion wird die Location gelöscht.</p>
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

  mixins: [Validation, Helpers],

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
        },
        address: {
          de: null,
          en: null,
        },
        map: null
      },

      // Validation
      errors: {
        description: false,
        address: false
      },

      // Routes
      routes: {
        find: '/api/dashboard/settings/location',
        store: '/api/dashboard/settings/location',
        update: '/api/dashboard/settings/location',
        delete: '/api/dashboard/settings/location',
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
      this.$store.commit('isLoading', true); 
      this.axios.post(this.routes.store, this.data).then(response => {
        this.$router.push({ name: 'settings', params: { type: 'locations' } });
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    update() {
      NProgress.start();
      this.$store.commit('isLoading', true);
      this.axios.put(`${this.routes.update}/${this.$route.params.id}`, this.data).then(response => {
        this.$router.push({ name: 'settings', params: { type: 'locations' } });
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    destroy() {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.delete(`${this.routes.delete}/${this.data.id}`).then(response => {
        this.$router.push({ name: 'settings', params: { type: 'locations' } });
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },
  },

  computed: {
    title() {
      return this.$props.type == 'edit' ? "Location bearbeiten" : "Location hinzufügen";
    },
  }
};
</script>
