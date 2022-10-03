<template>
<div class="media-upload">
  <div class="media-uploads">
    <div class="media-uploads__listing">
      <div
        class="media-uploads-item media-uploads-item--file"
        v-for="file in files"
        :key="file.uuid"
      >
        <div class="sm:span-9">
          <div class="text-xsmall mb-1x sm:mb-2x">
            {{ file.name | truncate(50, '...') }}
          </div>
          <input 
            type="text" 
            v-model="file.description" 
            placeholder="Bezeichnung..."
            @blur="update(file)"
          />
        </div>
        <file-actions 
          class="sm:span-3"
          :file="file" 
          :publish="file.publish" 
          :hasEdit="false" 
          :hasDownload="true"
          @toggle="toggle($event)"
          @destroy="destroy($event)">
        </file-actions>
      </div>
    </div>
  </div>
</div>
</template>
<script>
import { XIcon, DownloadIcon, EditIcon } from 'vue-feather-icons';
import FileActions from "@/shared/modules/files/components/Actions.vue";
import FileEdit from "@/shared/modules/files/mixins/edit";
import FileUtils from "@/shared/modules/files/mixins/utils";

export default {
  components: {
    FileActions,
    XIcon,
    DownloadIcon,
    EditIcon
  },

  props: {
    files: Array,
  },

  mixins: [FileEdit, FileUtils],

  data() {
    return {
      isFetched: false,
      isLoading: false,
      hasEdit:  false,
    };
  },

  mounted() {

  },

  methods: {

    toggle(file) {
      this.$emit('toggleFile', file);
    },

    destroy(file) {
      this.$emit('destroyFile', file);
    },

    update(file) {
      this.$emit('updateFile', file);
    },
  }
};
</script>