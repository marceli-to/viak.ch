<template>
  <div class="media-upload">

    <!-- listing -->
    <div class="media-uploads">
      <div class="media-uploads-view-toggle">
        <a href="" class="icon-media-uploads-view" @click.prevent="toggleView()">
          <span v-if="view == 'grid'">Listen Ansicht</span>
          <span v-if="view == 'list'">Grid Ansicht</span>
        </a>
      </div>
      <template v-if="view == 'list'">
        <div class="media-uploads__listing">
          <template>
            <draggable 
              :disabled="false"
              v-model="imageData" 
              @end="order"
              ghost-class="draggable-ghost"
              draggable=".is-draggable">
              <div class="media-uploads-item is-draggable" v-for="(image, index) in imageData" :key="index">
                <figure>
                  <img :src="getSource(image, 'thumbnail')" height="300" width="300">
                </figure>
                <div class="media-uploads-item__description">
                  <div class="mb-2x sm:mb-3x">
                    <label>{{ __('Bildlegende') }}</label>
                    <div>{{ image.caption ? image.caption : '–' }}</div>
                  </div>
                  <div>
                    <label>{{ __('Bildbeschreibung') }}</label>
                    <div>{{ image.description ? image.description : '–' }}</div>
                  </div>
                </div>
              </div>
            </draggable>
          </template>
        </div>
      </template>
      <template v-if="view == 'grid'">
        <div class="media-uploads__grid">
          <div v-for="(image, index) in images"
            :key="index"
            class="media-uploads-item">
            <figure>
              <a :href="getSource(image, 'cache')" target="_blank" class="media-uploads-item__preview">
                <img :src="getSource(image, 'thumbnail')" :class="[image.publish == 0 ? 'is-hidden' : '', '']" height="300" width="300">
                <figcaption v-if="image.type == 'teaser'">Vorschau</figcaption>
                <figcaption v-if="image.type == 'visual'">Hauptbild</figcaption>
              </a>
              <div class="media-uploads-item__actions">
                <image-actions 
                  :image="image" 
                  :hasPreview="false"
                  :publish="image.publish" 
                  :imagePreviewRoute="'cache'"
                  @toggleEdit="toggleEdit(image)"
                  @toggleImage="toggleImage(image)"
                  @destroyImage="destroyImage(image)"
                  @showCropper="showCropper(image)">
                </image-actions>
              </div>
            </figure>
          </div>
        </div>
      </template>
    </div>
    <!-- // listing -->

    <!-- cropper -->
    <div :class="[isCropping ? 'is-visible' : '', 'media-uploads-cropper']">
      <template v-if="!isLoading">
        <a
          href="javascript:;"
          class="icon-lightbox-close"
          @click.prevent="hideCropper()"
        >
          <icon-cross />
        </a>
        <div :class="[cropImage && cropImage.orientation ? 'is-' + cropImage.orientation : '', '']">
          <div class="media-uploads-cropper__formats">
            <a href="javascript:;" 
              @click.prevent="changeRatio(16,9)" 
              class="btn-crop-format">
              16:9
            </a>
            <a href="javascript:;" 
              @click.prevent="changeRatio(1,1)" 
              class="btn-crop-format">
              1:1
            </a>
          </div>
          <div class="media-uploads-cropper__info">{{ cropW }} x {{ cropH }}px</div>
          <cropper
            :src="cropImage"
            :defaultPosition="defaultPosition"
            :defaultSize="defaultSize"
            :stencilProps="{
              aspectRatio: this.ratio.w/this.ratio.h,
              linesClassnames: {
                default: 'line',
              },
              handlersClassnames: {
                default: 'handler'
              }
            }"
            @change="change"
          ></cropper>
          <div class="mt-2x">
            <div class="grid-cols-12">
              <a
                href="javascript:;"
                class="btn-secondary span-6"
                @click.prevent="hideCropper()">
                <span>Schliessen</span>
              </a>
              <a
                href="javascript:;"
                class="btn-primary span-6"
                @click.prevent="updateImage(currentImage)">
                <span>Speichern</span>
              </a>
            </div>
          </div>
        </div>
      </template>
    </div>
    <!-- // cropper -->

    <!-- edit -->
    <div :class="[isEdit ? 'is-visible' : '', 'media-uploads-edit']">
      <div>
        <a
          href="javascript:;"
          class="icon-lightbox-close"
          @click.prevent="hideEdit()"
        >
          <icon-cross />
        </a>
        <div class="sm:grid-cols-12">
          <figure class="sm:span-6">
              <img :src="getSource(currentImage, 'thumbnail')" height="300" width="300" v-if="isEdit">
          </figure>
          <div class="mt-4x sm:mt-0 sm:span-6">
            <form-group :label="__('Bildlegende')">
              <input type="text" v-model="currentImage.caption" />
            </form-group>
            <form-group :label="__('Bildbeschreibung')">
              <textarea v-model="currentImage.description"></textarea>
            </form-group>
            <form-group :label="__('Typ')">
              <div class="select-wrapper">
                <select v-model="currentImage.type">
                  <option value="teaser">{{ __('Vorschau') }}</option>
                  <option value="visual">{{ __('Hauptbild') }}</option>
                </select>
              </div>
            </form-group>
          </div>
        </div>
        <div class="mt-4x sm:mt-8x">
          <div class="grid-cols-12">
            <a href="javascript:;"
              class="btn-secondary span-6"
              @click.prevent="hideEdit()">
              {{ __('Schliessen') }}
            </a>
            <a
              href="javascript:;"
              class="btn-primary span-6"
              @click.prevent="update()">
              {{ __('Speichern') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- // edit -->
  </div>
</template>
<script>
import i18n from "@/shared/mixins/i18n";
import draggable from 'vuedraggable';
import { Cropper } from "vue-advanced-cropper";
import { DownloadIcon } from 'vue-feather-icons';
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";
import ImageActions from "@/shared/modules/images/components/Actions.vue";
import ImageCrop from "@/shared/modules/images/mixins/crop";
import ImageUtils from "@/shared/modules/images/mixins/utils";
import IconCross from "@/shared/components/ui/icons/Cross.vue";

export default {
  
  components: {
    ImageActions,
    IconCross,
    DownloadIcon,
    Cropper,
    draggable,
    FormGroup
  },

  mixins: [ImageUtils, ImageCrop, i18n],

  props: {

    images: {
      type: [Array, Object],
      default: [],
    },

    imagePreviewRoute: {
      type: String,
      default: "cache"
    },

    ratioW: {
      type: Number,
      default: 3
    },

    ratioH: {
      type: Number,
      default: 2
    },

    allowRatioSwitch: {
      type: Boolean,
      default: true,
    }
  },

  data() {
    return {

      // Data
      imageData: null,
      view: 'grid',
      ratio: {
        w: null,
        h: null
      },

      currentImage: {
        type: 'teaser'
      },
      
      // States
      isFetched: false,
      isLoading: false,
      isEdit: false,

      // Routes
      routes: {
        update: '/api/image',
      },

      // Messages
      messages: {
        updated: 'Daten aktualisiert!',
      },
    };
  },

  mounted() {
    this.imageData = this.$props.images;
    this.ratio.w = this.$props.ratioW;
    this.ratio.h = this.$props.ratioH;
  },

  methods: {

    changeRatio(w,h) {
      this.ratio.w = w;
      this.ratio.h = h;
      this.resetCropper();
    },

    resetCropper() {
      let image = this.currentImage;
      this.hideCropper();
      this.showCropper(image, true)
    },

    update() {
      this.axios.put(`${this.routes.update}/${this.currentImage.id}`, this.currentImage).then((response) => {
        this.$notify({type: 'success', text: this.messages.updated});
        this.hideEdit();
      });
    },

    order() {
      let images = this.imageData.map(function(image, index) {
        image.order = index;
        return image;
      });

      if (this.debounce) return;
      this.debounce = setTimeout(function(images) {
        this.debounce = false;
        let uri = `/api/images/order`;
        this.axios.post(uri, {images: images}).then((response) => {
          this.$notify({type: 'success', text: 'Reihenfolge angepasst'});
        });
      }.bind(this, images), 1000);
    },

    destroyImage(image) {
      this.$emit('destroyImage', image.name);
    },

    toggleImage(image) {
      this.$emit('toggleImage', image);
    },

    toggleEdit(image = null) {
      this.isEdit = this.isEdit ? false : true;
      this.currentImage = image;
    },

    hideEdit() {
      this.isEdit = false;
    },

    showEdit() {
      this.isEdit = true;
    },

    toggleView() {
      this.imageData = this.$props.images;
      this.view = this.view == 'grid' ? 'list' : 'grid';
    }
  }

};
</script>