<template>
<div>
  <form @submit.prevent="submit" v-if="isFetched">
    <form-group :label="'Betreff'" :required="true" :error="errors.subject">
      <input 
        type="text" 
        v-model="data.subject" 
        required 
        @focus="removeValidationError('subject')" />
    </form-group>
    <form-group :label="'Nachricht'" :required="true" :error="errors.body">
      <tinymce-editor
        :api-key="tinyApiKey"
        :init="tinyConfig"
        v-model="data.body"
      ></tinymce-editor>
    </form-group>
    <form-group :label="'Anhänge (max. 32 MB)'">
      <files 
        class="form-group__upload"
        :fetchFiles="false"
        @fileDestroyed="removeFile($event)" 
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
      <a href="" @click.prevent="submit()" :class="[$store.state.isLoading ? 'is-disabled' : '', 'btn-primary']">
        {{ __('Senden') }}
      </a>
    </form-group>
  </form>
</div>
</template>
<script>
import NProgress from 'nprogress';
import Validation from "@/shared/mixins/Validation";
import i18n from "@/shared/mixins/i18n";
import TinymceEditor from "@tinymce/tinymce-vue";
import tinyConfig from "@/shared/config/tiny.js";
import Helpers from "@/shared/mixins/Helpers";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";
import Files from "@/shared/modules/files/Index.vue";

export default {

  components: {
    NProgress,
    FormGroup,
    IconArrowRight,
    Files,
    TinymceEditor
  },

  mixins: [Validation, Helpers, i18n],

  props: {
    redirect: {
      type: String,
      default: null,
    }
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
      isAdmin: false,
      isExpert: false,

      // Tiny configuration
      tinyConfig: tinyConfig,
      tinyApiKey: 'vuaywur9klvlt3excnrd9xki1a5lj25v18b2j0d0nu5tbwro',

      // Messages
      messages: {
        stored: 'Nachricht erfasst!',
      },
    };
  },

  methods: {
  
    submit() {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.post(this.routes.store, this.data).then(response => {
        NProgress.done();
        this.$store.commit('isLoading', true); 
        this.$router.push({ name: this.$props.redirect, params: { uuid: this.$route.params.uuid } });
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
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
  