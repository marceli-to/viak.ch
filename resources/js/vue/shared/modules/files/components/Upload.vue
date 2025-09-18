<template>
  <div>
    <vue-dropzone-file
      ref="dropzone"
      id="dropzone"
      :options="dropzoneConfig"
      @vdropzone-complete="complete"
    ></vue-dropzone-file>
    <span class="requirements">{{restrictions}}</span>
    <notification ref="notification"></notification>
  </div>
</template>
<script>
import vue2Dropzone from "vue2-dropzone";
import dropzoneConfig from "@/shared/modules/files/config/upload.js";
import Notification from "@/shared/components/ui/misc/Notification.vue";

export default {

  components: {
    vueDropzoneFile: vue2Dropzone,
    Notification,
  },

  props: {
    restrictions: String,
    acceptedFiles: String,
    maxFiles: Number,
    maxFilesize: Number,
  },

  data() {
    return {
      dropzoneConfig: dropzoneConfig,
      messages: {}
    };
  },

  computed: {
    uploadError() {
      const formats = this.acceptedFiles.replace(/\./g, '').replace(/,/g, ', ').toUpperCase();
      return `Ungültiges Format oder Datei zu gross. Erlaubt sind: ${formats} | max. ${this.maxFilesize} MB`;
    }
  },

  created() {
    this.dropzoneConfig.acceptedFiles = this.$props.acceptedFiles;
    this.dropzoneConfig.maxFiles = this.$props.maxFiles;
    this.dropzoneConfig.maxFilesize = this.$props.maxFilesize;
  },

  methods: {

    complete(file) {
      if (file.status == "error" || file.accepted == false) {
        this.$refs.notification.init({
          message: this.uploadError,
          type: 'alert',
          style: 'error',
        });
      } 
      else {
        let response = JSON.parse(file.xhr.response);
        this.$parent.storeFile(response);
      }
      this.$refs.dropzone.removeFile(file);
    },
  }
};
</script>