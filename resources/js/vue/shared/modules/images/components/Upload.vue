<template>
  <div>
    <vue-dropzone-image
      ref="dropzoneImage"
      id="dropzoneImage"
      :options="dropzoneConfig"
      @vdropzone-complete="complete"
    ></vue-dropzone-image>
    <span class="requirements">{{restrictions}}</span>
  </div>
</template>
<script>
import vue2Dropzone from "vue2-dropzone";
import dropzoneConfig from "@/shared/modules/images/config/upload.js";

export default {

  components: {
    vueDropzoneImage: vue2Dropzone,
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
        uploadError: 'Ungültiges Format oder Datei zu gross. Erlaubt sind die Formate "JPG" und "PNG", bis max. 16 MB'
      }
    };
  },

  created() {
    this.dropzoneConfig.acceptedFiles = this.$props.acceptedFiles;
    this.dropzoneConfig.maxFiles = this.$props.maxFiles;
    this.dropzoneConfig.maxFilesize = this.$props.maxFilesize;
  },

  methods: {

    complete(image) {
      if (image.status == "error" || image.accepted == false) {
        this.$refs.notification.init({
          message: this.messages.uploadError,
          type: 'alert',
          style: 'error',
        });
      } 
      else {
        let response = JSON.parse(image.xhr.response);
        this.$emit('store', response);
      }
      this.$refs.dropzoneImage.removeFile(image);
    },
  }
};
</script>