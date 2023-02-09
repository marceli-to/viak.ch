<template>
  <form @submit.prevent="submit" v-if="isFetched">
    <article-text>
      <template #aside>
        <h1 class="xs:hide">Rechnung bearbeiten</h1>
        <back-link :route="'backoffice-invoices'"></back-link>
      </template>
      <template #content>
        <form-group :label="'Nummer'">
          <input type="text" disabled :value="data.number" />
        </form-group>
        <form-group :label="'Student'">
          <input type="text" disabled :value="data.user.fullname" />
        </form-group>
        <form-group :label="'Rechnungsadresse'">
          <textarea v-model="data.invoice_address" class="is-large"></textarea>
        </form-group>
        <form-group>
          <a href="" @click.prevent="update()" :class="[$store.state.isLoading ? 'is-disabled' : '', 'btn-primary']">
            Speichern
          </a>
        </form-group>
      </template>
    </article-text>
  </form>
</template>
<script>
import NProgress from 'nprogress';
import Validation from "@/shared/mixins/Validation";
import Helpers from "@/shared/mixins/Helpers";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import BackLink from "@/shared/components/ui/misc/BackLink.vue";

export default {

  components: {
    NProgress,
    ArticleText,
    Grid,
    GridCol,
    FormGroup,
    BackLink,
    CollapsibleContainer,
    Collapsible,
  },

  mixins: [Validation, Helpers],

  props: {
    type: String
  },

  data() {
    return {
      
      // Model
      data: {
        invoice_address: null,
      },

      // Validation
      errors: {  
      },

      // Routes
      routes: {
        find: '/api/dashboard/invoice',
        update: '/api/dashboard/invoice',
      },

      // States
      isFetched: true,
      isLoading: false,
    };
  },

  created() {
    this.fetch();
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

    update() {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.put(`${this.routes.update}/${this.$route.params.id}`, this.data).then(response => {
        this.$router.push({ name: 'backoffice-invoices'});
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },
  },
};
</script>
  