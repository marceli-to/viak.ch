<template>
<div>
  <div class="sm:span-4">
    <span v-if="$props.file.description">
      {{ $props.file.description + ' (' + $props.file.original_name + ')' | truncate(35, '...') }} 
    </span>
    <span v-else>{{ $props.file.original_name | truncate(35, '...') }}</span>
  </div>
  <div class="sm:span-3">
    {{ $props.file.uploaded_at }}
  </div>
  <div class="sm:span-2">
    {{ $props.file.size | fileSize() }}
  </div>
  <div class="sm:span-3 flex justify-end">
    <div>
      <a :href="`/storage/uploads/${file.name}`" target="_blank" class="btn-primary btn-auto-w mb-2x">
        {{ __('Download') }}
      </a>
      <slot name="action" />
    </div>
  </div>
</div>
</template>
<script>
import i18n from "@/shared/mixins/i18n";

export default {

  mixins: [i18n],

  props: {
    file: {
      type: Object,
      default: null
    }
  }
}
</script>