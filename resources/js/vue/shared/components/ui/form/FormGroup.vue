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
export default {
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
