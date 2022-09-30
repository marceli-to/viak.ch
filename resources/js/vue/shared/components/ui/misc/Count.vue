<template>
  <strong>({{ this.$props.count }})</strong>
</template>
<script>
export default {

  props: {
    count: {
      type: [String, Number],
      default: 0,
    }
  },
}
</script>
  
