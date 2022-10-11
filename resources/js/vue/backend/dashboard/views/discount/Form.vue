<template>
<form @submit.prevent="submit" v-if="isFetched">
  <article-text>
    <template #aside>
      <h1 class="xs:hide">{{ title }}</h1>
      <back-link :route="'discount-codes'"></back-link>
    </template>
    <template #content>
      <form-group :label="'Code'" :required="true" :error="errors.code">
        <input type="text" v-model="data.code" disabled required @focus="removeError('firstname')" />
      </form-group>
      <form-group :label="'Betrag oder Prozentsatz'" :required="true" :error="errors.amount">
        <input type="number" min="0" v-model="data.amount" required @focus="removeError('amount')" />
      </form-group>

      <grid class="grid-cols-12">
        <grid-col class="span-6">
          <form-group :label="'Gültig ab'" :error="errors.valid_from">
            <the-mask
              type="text"
              mask="##.##.####"
              :masked="true"
              name="valid_from"
              placeholder="dd.mm.YYYY"
              @focus="removeError('valid_from')"
              v-model="data.valid_from">
            </the-mask>
          </form-group>
        </grid-col>
        <grid-col class="span-6">
          <form-group :label="'Gültig bis'" :error="errors.valid_to">
            <the-mask
              type="text"
              mask="##.##.####"
              :masked="true"
              name="valid_to"
              placeholder="dd.mm.YYYY"
              @focus="removeError('valid_to')"
              v-model="data.valid_to">
            </the-mask>
          </form-group>
        </grid-col>
      </grid>

      <grid class="grid-cols-12 mt-3x mb-3x">
        <grid-col class="span-3">
          <form-group class="flex items-center">
            <input type="radio" id="discount-type-fix" name="discount-type" required value="1" v-model="data.fix" @change="setType('fix')">
            <label for="discount-type-fix">Fixbetrag</label>
          </form-group>
        </grid-col>
        <grid-col class="span-3">
          <form-group class="flex items-center">
            <input type="radio" id="discount-type-percent" name="discount-type" required value="1" v-model="data.percent" @change="setType('percent')">
            <label for="discount-type-percent">Prozent</label>
          </form-group>
        </grid-col>
      </grid>

      <form-group>
        <a href="" @click.prevent="submit()" :class="[isLoading ? 'is-disabled' : '', 'btn-primary']">
          Speichern
        </a>
      </form-group>
      <div class="form-danger-zone is-danger" v-if="$props.type == 'edit'">
        <h2>Rabatt-Code löschen</h2>
        <p>Mit dieser Aktion wird der Rabatt-Code gelöscht.</p>
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
import { TheMask } from "vue-the-mask";
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
    TheMask
  },

  mixins: [ErrorHandling, Helpers],

  props: {
    type: String
  },

  data() {
    return {
      
      // Model
      data: {
        code: null,
        amount: null,
        valid_from: null,
        valid_to: null,
        percent: 0,
        fix: 1,
      },

      // Validation
      errors: {

      },

      // Routes
      routes: {
        find: '/api/dashboard/discount-code',
        create: '/api/dashboard/discount-code/create',
        store: '/api/dashboard/discount-code',
        update: '/api/dashboard/discount-code',
        delete: '/api/dashboard/discount-code',
      },

      // States
      isFetched: true,
      isLoading: false,
    };
  },

  created() {
    if (this.$props.type == 'edit') {
      this.fetch();
    }
    if (this.$props.type == 'create') {
      this.create();
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

    create() {
      NProgress.start();
      this.axios.get(`${this.routes.create}`).then(response => {
        this.data.code = response.data;
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
        this.$router.push({ name: 'discount-codes'});
        NProgress.done();
        this.isLoading = true;
      });
    },

    update() {
      this.axios.put(`${this.routes.update}/${this.$route.params.id}`, this.data).then(response => {
        this.$router.push({ name: 'discount-codes'});
      });
    },

    destroy() {
      this.isLoading = true;
      NProgress.start();
      this.axios.delete(`${this.routes.delete}/${this.data.id}`).then(response => {
        this.$router.push({ name: 'discount-codes'});
        this.isLoading = false;
        NProgress.done();
      });
    },

    setType(type) {
      this.data.fix = 0;
      this.data.percent = 0;
      this.data[type] = 1;
    }
  },

  computed: {
    title() {
      return this.$props.type == 'edit' ? "Rabatt-Code bearbeiten" : "Rabatt-Code hinzufügen";
    },
  }
};
</script>
