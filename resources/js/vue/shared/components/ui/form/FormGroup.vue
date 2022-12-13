<template>
  <div :class="[$props.error ? 'is-invalid' : '', 'form-group']">
    <template v-if="$props.label">
      <label :class="[required ? 'is-required' : '', '']">
        {{ $props.error ? $props.error : $props.label }}
        <template v-if="required">*</template>
      </label>
    </template>
    <slot />
  </div>
</template>
<script>
import IconFlagEn from "@/shared/components/ui/icons/FlagEn.vue";

export default {

  components: {
    IconFlagEn
  },

  props: {
    
    label: {
      type: String,
      default: ''
    },

    required: {
      type: [Boolean, Number],
      default: false
    },

    error: {
      type: [String, Boolean],
      default: false,
    }
  }
 
}
</script>
