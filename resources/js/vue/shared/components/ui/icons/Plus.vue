<template>
<div>
  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" v-if="$props.size == 'lg'">
    <path fill="currentColor" d="M20 9h-9V0H9v9H0v2h9v9h2v-9h9z"/>
  </svg>
  <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 16 16" v-else>
    <path fill="currentColor" d="M16 7.2H8.8V0H7.2v7.2H0v1.6h7.2V16h1.6V8.8H16V7.2z"/>
  </svg>
</div>
</template>
<script>
export default {
  props: {
    size: {
      type: String,
      default: 'lg',
    }
  },
}
</script>
