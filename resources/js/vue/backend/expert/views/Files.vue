<template>
<form @submit.prevent="submit" v-if="isFetched">
  <article-text>
    <template #aside>
      <h1 class="xs:hide">{{ __('Dokumente hochladen') }}</h1>
      <back-link :route="`${_getLocale()}-expert-course-event`"></back-link>
    </template>
    <template #content>
        <files 
        class="form-group__upload"
        :fetchFiles="false"
        @fileDestroyed="removeFile($event)" 
        @fileStored="addFile($event)">
      </files>
      <form-group class="line-before">
        <a href="" @click.prevent="submit()" :class="[isLoading || data.files.length == 0 ? 'is-disabled' : '', 'btn-primary']">
          {{ __('Speichern') }}
        </a>
      </form-group>
    </template>
  </article-text>
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
import Files from "@/shared/modules/files/Index.vue";
import BackLink from '@/shared/components/ui/misc/BackLink.vue';

export default {

  components: {
    NProgress,
    ArticleText,
    FormGroup,
    Files,
    BackLink
  },

  mixins: [ErrorHandling, Helpers, i18n, Meta],

  props: {
    type: String
  },

  data() {
    return {
      
      // Model
      data: {
        event_uuid: this.$route.params.uuid,
        files: []
      },

      // Routes
      routes: {
        store: '/api/event/file',
      },

      // States
      isFetched: true,
      isLoading: false,
    };
  },

  mounted() {
    this.setTitle(this.__('Dateien hochladen'));
  },  

  methods: {
  
    submit() {
      NProgress.start();
      this.isLoading = true;
      this.axios.post(this.routes.store, this.data).then(response => {
        NProgress.done();
        this.isLoading = true;
        this.$router.push({ name: `${this._getLocale()}-expert-course-event`, params: { uuid: this.$route.params.uuid } });
      });
    },

    addFile(uuid) {
      this.data.files.push(uuid);
    },

    removeFile(uuid) {
      const index = this.data.files.findIndex(x => x.uuid === uuid);
      this.data.files.splice(index, 1);
    },
  },
};
</script>
    