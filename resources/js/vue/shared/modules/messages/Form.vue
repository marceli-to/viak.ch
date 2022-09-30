<template>
<form @submit.prevent="submit" v-if="isFetched">
  <article-text>
    <template #aside>
      <h1 class="xs:hide">{{ __('Nachricht erstellen') }}</h1>
      <p class="text-small sm:mt-3x">Sende eine Nachricht an alle Studenten dieses Kurses.</p>
      <div class="sm:mt-5x md:mt-10x">
        <router-link :to="{ name: 'expert-course-event' }" class="icon-arrow-right:below">
          <span>Zurück</span>
          <icon-arrow-right :size="'sm'" />
        </router-link>
      </div>
    </template>
    <template #content>
      
      <form-group :label="'Betreff'" :required="true" :error="errors.subject">
        <input 
          type="text" 
          v-model="data.subject" 
          required 
          @focus="removeError('subject')" />
      </form-group>
      
      <form-group :label="'Nachricht'" :required="true" :error="errors.message">
        <textarea 
          v-model="data.message" 
          required 
          class="is-large"
          @focus="removeError('message')">
        </textarea>
      </form-group>

      <form-group class="has-underline flex mt-4x">
        <div class="form-group__checkbox">
          <input type="checkbox" id="selfcopy" name="selfcopy" :value="1" v-model="data.selfcopy">
          <label for="selfcopy">{{ __('Kopie an mich') }}</label>
        </div>
      </form-group>

      <form-group>
        <a href="" @click.prevent="submit()" :class="[isLoading ? 'is-disabled' : '', 'btn-primary']">
          Senden
        </a>
      </form-group>

    </template>
  </article-text>
  <notification ref="notification" />
</form>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import i18n from "@/shared/mixins/i18n";
import Meta from "@/shared/mixins/Meta";
import Helpers from "@/shared/mixins/Helpers";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";

export default {

  components: {
    NProgress,
    ArticleText,
    FormGroup,
    IconArrowRight,
  },

  mixins: [ErrorHandling, Helpers, i18n, Meta],

  props: {
    type: String
  },

  data() {
    return {
      
      // Model
      data: {
        subject: null,
      },

      // Validation
      errors: {
        description: false,
      },

      // Routes
      routes: {
        find: '/api/message',
        store: '/api/message',
      },

      // States
      isFetched: true,
      isLoading: false,

      // Messages
      messages: {
        stored: 'Nachricht erfasst!',
      },
    };
  },

  mounted() {
    this.setTitle(this.__('Nachricht erstellen'));
  },  

  methods: {
  
    submit() {
      NProgress.start();
      this.isLoading = true;

      let data = {
        subject: this.data.subject,
        message: this.data.message,
        uuid: this.$route.params.uuid,
      }

      this.axios.post(this.routes.store, data).then(response => {
        this.$router.push({ name: 'expert-course-event', params: { uuid: this.$route.params.uuid } });
        NProgress.done();
        this.isLoading = true;
      });
    },
  },
};
</script>
  