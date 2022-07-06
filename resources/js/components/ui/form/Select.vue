<template>
  <select
    :class="classes"
    style="background-position: center right"
    @change="$emit('update:modelValue', $event.target.value)"
    ref="select">
    <slot />
  </select>
</template>
<script>
export default {
  props: ['modelValue', 'size'],

  emits: ['update:modelValue'],

  created() {
  },

  computed: {
    classes() {
      if (this.$props.size == 'sm') {
      } 
      else {
      }
    },
  }
}
</script>
