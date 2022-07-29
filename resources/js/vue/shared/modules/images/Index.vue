<template>
<div>
  <template v-if="isFetched">
    <div class="mt-2x sm:mt-4x">
      <image-upload
        :restrictions="'jpg, png | max. 16 MB'"
        :maxFiles="99"
        :maxFilesize="32"
        :acceptedFiles="'.png, .PNG, .jpg, .jpeg, .JPG, .JPEG'"
        @store="storeImage($event)"
      ></image-upload>
    </div>
    <div class="mt-2x sm:mt-4x">
      <image-edit 
        :images="data"
        :imagePreviewRoute="'cache'"
        :ratioW="this.$props.imageRatioW"
        :ratioH="this.$props.imageRatioH"
        :allowRatioSwitch="this.$props.allowRatioSwitch"
        @toggleImage="toggleImage($event)"
        @destroyImage="destroyImage($event)"
        @updateImage="updateImage($event)">
      </image-edit>
    </div>
  </template>
</div>
</template>
<script>
import NProgress from 'nprogress';
import Helpers from "@/shared/mixins/Helpers";
import i18n from "@/shared/mixins/i18n";
import ImageUpload from "@/shared/modules/images/components/Upload.vue";
import ImageEdit from "@/shared/modules/images/components/Edit.vue";

export default {

  components: {
    NProgress,
    ImageUpload,
    ImageEdit
  },

  mixins: [Helpers, i18n],

  props: {
    imageRatioW: {
      type: Number,
      default: 3
    },

    imageRatioH: {
      type: Number,
      default: 2
    },

    allowRatioSwitch: {
      type: Boolean,
      default: false,
    },

    typeId: null,
    type: null,
    images: null,

  },

  data() {
    return {

      // Data
      data: null,

      // Routes
      routes: {
        get: '/api/images',
        store: '/api/image',
        delete: '/api/image',
        toggle: '/api/image/state',
        coords: '/api/image/coords',
      },

      // States
      isFetched: false,

      // Notifications
      notifications: {
        emptyData: 'Es sind noch keine Dateien vorhanden...',
        saved: 'Bild gespeichert',
        updated: 'Änderungen gespeichert',
        confirmDelete: 'Bitte löschen bestätigen'
      },
    };
  },

  created() {
    if (this.$props.images) {
      this.data = this.$props.images;
      this.isFetched = true;
    }
    else {
      this.fetch();
    }
  },

  methods: {

    fetch() {
      this.axios.get(`${this.routes.get}`).then(response => {
        this.data = response.data.data;
        this.isFetched = true;
      });
    },

    storeImage(image) {
      let img = {
        id: null,
        name: image.name,
        original_name: image.original_name,
        size: image.size,
        extension: image.extension,
        orientation: image.orientation,
        coords_w: 0,
        coords_h: 0,
        coords_x: 0,
        coords_y: 0,
        publish: 1,
        imageable_id: this.$props.typeId,
        imageable_type: this.$props.type,
      };

      NProgress.start();
      this.axios.post(`${this.routes.store}`, img).then(response => {
        alert(this.__(this.notifications.saved));
        img.id = response.data.imageId;
        this.data.push(img);
        NProgress.done();
      });
    },

    destroyImage(image) {
      if (confirm(this.__(this.notifications.confirmDelete))) {
        NProgress.start();
        this.axios.delete(`${this.routes.delete}/${image}`).then(response => {
          const index = this.data.findIndex(x => x.name === image);
          this.data.splice(index, 1);
          NProgress.done();
        });
      }
    },

    toggleImage(image) {
      NProgress.start();
      this.axios.get(`${this.routes.toggle}/${image.id}`).then(response => {
        const index = this.data.findIndex(x => x.id === image.id);
        this.data[index].publish = response.data;
        NProgress.done();
      });
    },

    updateImage(image) {
      NProgress.start();
      this.axios.put(`${this.routes.coords}/${image.id}`, image).then(response => {
        alert(this.__(this.notifications.updated));
        NProgress.done();
      });
    },
  }
}
</script>