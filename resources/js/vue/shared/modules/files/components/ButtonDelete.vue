<template>
<div>
  <a href="" class="btn-secondary btn-auto-w" @click.prevent="confirmDestroy()">
    {{ __('Löschen') }}
  </a>
  <notification ref="notification">
    <template #actions>
      <a href="javascript:;" @click="destroy()" class="btn-primary">{{ __('Bestätigen') }}</a>
      <a href="javascript:;" @click="$refs.notification.hide()" class="btn-secondary">{{ __('Abbrechen') }}</a>
    </template>
  </notification>
</div>
</template>
<script>
import NProgress from 'nprogress';
import Validation from "@/shared/mixins/Validation";
import i18n from "@/shared/mixins/i18n";

export default {
  
  components: {
    NProgress,
  },

  mixins: [Validation, i18n],

  props: {
    file: {
      type: Object,
      default: null
    }
  },

  data() {
    return {
      routes: {
        delete: '/api/file',
      },
    };
  },

  methods: {

    confirmDestroy() {
      this.$refs.notification.init({
        message: 'Bitte Löschen bestätigen!',
        type: 'dialog',
        style: 'info',
      });
    },

    destroy() {
      NProgress.start();
      this.axios.delete(`${this.routes.delete}/${this.$props.file.uuid}`).then(response => {
        this.$emit('fileDeleted', this.$props.file);
        NProgress.done();
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },
  }

}
</script>