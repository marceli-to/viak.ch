<template>
  <div class="flex justify-end">

    <template v-if="$slots.buttons">
      <slot name="buttons" />
    </template>

    <div class="ml-2x sm:ml-3x" v-if="$props.hasDownload">
      <a
        :href="`/storage/temp/${file.name}`"
        class="feather-icon"
        target="_blank">
        <download-cloud-icon size="18"></download-cloud-icon>
      </a>
    </div>
    <div class="ml-2x sm:ml-3x" v-if="$props.hasEdit">
      <a
        href="javascript:;"
        class="feather-icon"
        @click.prevent="edit(file)">
        <edit-icon size="18"></edit-icon>
      </a>
    </div>
    <div class="ml-2x sm:ml-3x" v-if="$props.hasDestroy">
      <a
        href="javascript:;"
        class="feather-icon"
        @click.prevent="destroy(file)">
        <trash-2-icon size="18"></trash-2-icon>
      </a>
    </div>
  </div>
</template>
<script>
import { EditIcon, Trash2Icon, DownloadCloudIcon} from 'vue-feather-icons';

export default {

  components: {
    EditIcon,
    Trash2Icon,
    DownloadCloudIcon
  },

  props: {
    file: Object,
    publish: Number,

    hasDownload: {
      type: Boolean,
      default: false
    },

    hasDestroy: {
      type: Boolean,
      default: true
    },

    hasEdit: {
      type: Boolean,
      default: true
    },
  },

  methods: {

    toggle(file) {
      this.$emit('toggle', file);
    },

    destroy(file) {
      this.$emit('destroy', file);
    },

    edit(file) {
      this.$emit('edit', file);
    },
  }
}
</script>
