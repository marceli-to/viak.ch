<template>
  <div>
    <vue-dropzone-file
      ref="dropzone"
      id="dropzone"
      :options="dropzoneConfig"
      @vdropzone-complete="complete"
    ></vue-dropzone-file>
    <span class="requirements">{{restrictions}}</span>
  </div>
</template>
<script>
import vue2Dropzone from "vue2-dropzone";
import dropzoneConfig from "@/shared/modules/files/config/upload.js";

export default {

  components: {
    vueDropzoneFile: vue2Dropzone,
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
      messages: {
        uploadError: 'Ungültiges Format oder Datei zu gross. Erlaubt sind die Formate "PDF", "ZIP", "TXT" und "DOC" bis max. 16 MB!'
      }
    };
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
          message: this.messages.uploadError,
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