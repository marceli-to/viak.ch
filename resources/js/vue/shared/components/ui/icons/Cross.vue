<template>
<div>
  <svg xmlns="http://www.w3.org/2000/svg" height="12" width="12" viewBox="0 0 16 16" v-if="$props.size == 'sm'">
    <path fill="#969696" d="M14.759 0L7.978 6.781 1.285.044.044 1.285l6.692 6.738L0 14.759l1.152 1.197 6.781-6.781L14.759 16 16 14.759 9.175 7.934l6.736-6.737z"/>
  </svg>
  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" v-else>
    <path fill="currentColor" d="M20.116 0L11 9.01 1.886 0 0 1.886 9.166 11l-8.59 8.538L2.41 21.53 11 12.939l8.54 8.591 1.886-1.992L12.834 11 22 1.886z"/>
  </svg>
</div>
</template>
<script>
export default {
  props: {
    size: {
      type: String,
      default: 'md',
    },
  },
}
</script>