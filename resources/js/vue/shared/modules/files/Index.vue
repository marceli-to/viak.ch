<template>
<div>
  <template v-if="isFetched">
    <div class="mt-2x sm:mt-4x">
      <file-upload
        :restrictions="'pdf, zip, txt, doc, ppt, xls | max. 32 MB'"
        :maxFiles="99"
        :maxFilesize="32"
        :acceptedFiles="'.pdf,.zip,.txt,.doc,.docx,.xls,.xlsx,.ppt,.pptx'"
        @uploadCompleted="storeFile($event)"
      ></file-upload>
    </div>
    <div class="mt-4x sm:mt-8x">
      <file-edit 
        :files="data" 
        @updateFile="updateFile($event)"
        @destroyFile="confirmDestroyFile($event)">
      </file-edit>
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
    fetchFiles: {
      type: Boolean,
      default: true
    }
  },

  data() {
    return {

      // Current file (for deletion)
      currentFile: null,

      // Data
      data: [],

      // Routes
      routes: {
        get: '/api/files',
        store: '/api/file',
        delete: '/api/file',
        update: '/api/file',
        toggle: '/api/file/state',
      },

      // States
      isLoading: false,
      isFetched: false,

      // Messages
      notifications: {
        emptyData: 'Es sind noch keine Dateien vorhanden...',
        saved: 'Datei gespeichert',
        deleted: 'Datei gelöscht',
        updated: 'Änderungen gespeichert',
      },
    };
  },

  created() {
    this.isFetched = true;
    if (this.$props.files) {
      this.data = this.$props.files;
    }
    else if (this.$props.fetchFiles) {
      this.fetch();
    }
  },

  methods: {

    fetch() {
      this.isFetched = false;
      NProgress.start();
      this.axios.get(`${this.routes.get}`).then(response => {
        this.data = response.data.data;
        this.isFetched = true;
        NProgress.done();
      });
    },

    storeFile(file) {
      let f = {
        id: null,
        uuid: null,
        name: file.name,
        original_name: file.original_name,
        size: file.size,
        extension: file.extension,
        publish: 1,
        fileable_id: this.$props.typeId,
        fileable_type: this.$props.type,
      };

      NProgress.start();
      this.axios.post(`${this.routes.store}`, file).then(response => {
        file.id = response.data.file.id;
        file.uuid = response.data.file.uuid;
        this.data.push(file);
        this.$emit('fileStored', response.data.file.uuid);
        this.$toast.open(this.__(this.notifications.saved));
        NProgress.done();
      });
    },

    confirmDestroyFile(file) {
      this.currentFile = file;
      this.$refs.notification.init({
        message: 'Bitte Löschen bestätigen!',
        type: 'dialog',
        style: 'info',
      });
    },

    destroyFile() {
      NProgress.start();
      this.axios.delete(`${this.routes.delete}/${this.currentFile.uuid}`).then(response => {
        this.$emit('fileDestroyed', this.currentFile.uuid);
        const index = this.data.findIndex(x => x.uuid === this.currentFile.uuid);
        this.data.splice(index, 1);
        this.currentFile = null;
        this.$refs.notification.hide();
        this.$toast.open(this.__(this.notifications.deleted));
        NProgress.done();
      });
    },

    updateFile(file) {
      this.axios.put(`${this.routes.update}/${file.uuid}`, file).then((response) => {
        this.$toast.open(this.__(this.notifications.updated));
      });
    },

    toggleFile(file) {
      NProgress.start();
      this.axios.get(`${this.routes.toggle}/${file.id}`).then(response => {
        const index = this.data.findIndex(x => x.uuid === file.uuid);
        this.data[index].publish = response.data;
        NProgress.done();
      });
    },
  }
}
</script>