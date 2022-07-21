<template>
  <div>

    <a
      href="javascript:;"
      class="feather-icon"
      @click.prevent="$emit('toggleImage', image)"
      v-if="hasToggle">
      <eye-icon size="18" v-if="publish"></eye-icon>
      <eye-off-icon size="18" v-if="!publish"></eye-off-icon>
    </a>
    
    <a
      href="javascript:;"
      class="feather-icon"
      @click.prevent="$emit('toggleEdit', image)"
      v-if="hasEdit">
      <edit-icon size="18"></edit-icon>
    </a>

    <a 
      :href="getSource(image, imagePreviewRoute)" 
      target="_blank" 
      class="feather-icon"
      v-if="hasPreview">
      <image-icon size="18"></image-icon>
    </a>

    <a
      href="javascript:;"
      class="feather-icon"
      @click.prevent="$emit('destroyImage', image)">
      <trash-2-icon size="18"></trash-2-icon>
    </a>

    <a
      href="javascript:;"
      class="feather-icon xs:hide"
      @click.prevent="$emit('showCropper', image)"
      v-if="hasCrop">
      <crop-icon size="18"></crop-icon>
    </a>

  </div>
</template>
<script>
import { EyeIcon, EyeOffIcon, EditIcon, Trash2Icon, CropIcon, ImageIcon} from 'vue-feather-icons';
import ImageUtils from "@/shared/modules/images/mixins/utils";
export default {

  components: {
    EyeIcon,
    EyeOffIcon,
    EditIcon,
    Trash2Icon,
    CropIcon,
    ImageIcon
  },

  props: {
    image: Object,
    
    publish: Number,

    hasEdit: {
      type: Boolean,
      default: true
    },

    hasPreview: {
      type: Boolean,
      default: true
    },

    hasCrop: {
      type: Boolean,
      default: true
    },

    hasToggle: {
      type: Boolean,
      default: true
    },

    imagePreviewRoute: {
      type: String,
      default: 'large'
    },
  },

  mixins: [ImageUtils],
}
</script>
