<template>
<form @submit.prevent="submit" v-if="isFetched">
  <article-text>
    <template #aside>
      <h1 class="xs:hide">{{ __('Nachricht erstellen') }}</h1>
      <p class="text-small sm:mt-3x">{{ __('Sende eine Nachricht an alle Studenten dieses Kurses.') }}</p>
      <div class="sm:mt-5x md:mt-10x">
        <router-link :to="{ name: 'expert-course-event' }" class="icon-arrow-right:below">
          <span>{{ __('Zurück') }}</span>
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
      
      <form-group :label="'Nachricht'" :required="true" :error="errors.body">
        <textarea 
          v-model="data.body" 
          required 
          class="is-large"
          @focus="removeError('body')">
        </textarea>
      </form-group>

      <form-group :label="'Anhänge'">
        <files 
          class="form-group__upload"
          :fetchFiles="false" 
          @fileStored="addFile($event)">
        </files>
      </form-group>

      <form-group class="line-after flex">
        <div class="form-group__checkbox">
          <input type="checkbox" id="selfcopy" name="selfcopy" :value="1" v-model="data.selfcopy">
          <label for="selfcopy">{{ __('Kopie der Nachricht an mich') }}</label>
        </div>
      </form-group>

      <form-group>
        <a href="" @click.prevent="submit()" :class="[isLoading ? 'is-disabled' : '', 'btn-primary']">
          {{ __('Senden') }}
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
import Files from "@/shared/modules/files/Index.vue";

export default {

  components: {
    NProgress,
    ArticleText,
    FormGroup,
    IconArrowRight,
    Files
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
        body: null,
        event_uuid: this.$route.params.uuid,
        selfcopy: false,
        files: []
      },

      // Validation
      errors: {
        description: false,
      },

      // Routes
      routes: {
        find: '/api/event/message',
        store: '/api/event/message',
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
      this.axios.post(this.routes.store, this.data).then(response => {
        NProgress.done();
        this.isLoading = true;
        this.$router.push({ name: 'expert-course-event', params: { uuid: this.$route.params.uuid } });
      });
    },

    addFile(uuid) {
      this.data.files.push(uuid);
    },
  },
};
</script>
  