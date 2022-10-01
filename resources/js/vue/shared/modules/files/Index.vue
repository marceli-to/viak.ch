<template>
<div>
  <template v-if="isFetched">
    <div class="mt-2x sm:mt-4x">
      <file-upload
        :restrictions="'pdf, zip, txt, doc | max. 32 MB'"
        :maxFiles="99"
        :maxFilesize="32"
        :acceptedFiles="'.pdf,.zip,.txt,.doc'"
      ></file-upload>
    </div>
    <div class="mt-2x sm:mt-4x">
      <file-edit :files="data"></file-edit>
    </div>
  </template>
  <notification ref="notification">
    <template #actions>
      <a href="javascript:;" @click="destroyFile()" class="btn-primary">{{ __('Bestätigen') }}</a>
      <a href="javascript:;" @click="$refs.notification.hide()" class="btn-secondary">{{ __('Abbrechen') }}</a>
    </template>
  </notification>
</div>
</template>
<script>
import NProgress from 'nprogress';
import Helpers from "@/shared/mixins/Helpers";
import i18n from "@/shared/mixins/i18n";
import FileUpload from "@/shared/modules/files/components/Upload.vue";
import FileEdit from "@/shared/modules/files/components/Edit.vue";

export default {

  components: {
    FileUpload,
    FileEdit
  },

  mixins: [Helpers, i18n],

  props: {
    typeId: null,
    type: null,
    files: null,
  },

  data() {
    return {

      // Current file (for deletion)
      currentFile: null,

      // Data
      data: null,

      // Routes
      routes: {
        get: '/api/files',
        store: '/api/file',
        delete: '/api/file',
        toggle: '/api/file/state',
      },

      // States
      isLoading: false,
      isFetched: false,

      // Messages
      messages: {
        emptyData: 'Es sind noch keine Dateien vorhanden...',
        saved: 'Datei gespeichert!',
        updated: 'Änderungen gespeichert!',
      },
    };
  },

  created() {
    if (this.$props.files) {
      this.data = this.$props.files;
      this.isFetched = true;
    }
    else {
      this.fetch();
    }
  },

  methods: {

    fetch() {
      NProgress.start();
      this.axios.get(`${this.routes.get}`).then(response => {
        this.data = response.data.data;
        this.isFetched = true;
        NProgress.done();
      });
    },

    storeFile(media) {
      let file = {
        id: null,
        name: media.name,
        original_name: media.original_name,
        size: media.size,
        extension: media.extension,
        publish: 1,
        fileable_id: this.$props.typeId,
        fileable_type: this.$props.type,
      };

      NProgress.start();
      this.axios.post(`${this.routes.store}`, file).then(response => {
        file.id = response.data.fileId;
        this.data.push(file);
        NProgress.done();
      });
    },

    confirmDestroyFile(image) {
      this.currentFile = image;
      this.$refs.notification.init({
        message: 'Bitte Löschen bestätigen!',
        type: 'dialog',
        style: 'info',
        autohide: false,
      });
    },

    // destroyFile(file) {
    //   NProgress.start();
    //   this.axios.delete(`${this.routes.delete}/${file}`).then(response => {
    //     const index = this.data.findIndex(x => x.name === file);
    //     this.data.splice(index, 1);
    //     NProgress.done();
    //   });
    // },

    destroyFile(file) {
      NProgress.start();
      this.axios.delete(`${this.routes.delete}/${this.currentFile}`).then(response => {
        const index = this.data.findIndex(x => x.name === this.currentFile);
        this.data.splice(index, 1);
        this.currentFile = null;
        NProgress.done();
      });
    },

    toggleFile(file) {
      NProgress.start();
      this.axios.get(`${this.routes.toggle}/${file.id}`).then(response => {
        const index = this.data.findIndex(x => x.id === file.id);
        this.data[index].publish = response.data;
        NProgress.done();
      });
    },
  }
}
</script>