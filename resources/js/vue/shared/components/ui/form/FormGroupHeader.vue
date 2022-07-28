<template>
  <div :class="[$props.error ? 'is-invalid' : '', 'form-group-header']">
    <slot />
  </div>
</template>
<script>
export default {
  props: {
    error: {
      type: [String, Boolean],
      default: false,
    }
  }
 
}
</script>
