<template>
  <div class="grid-item">
    <slot />
  </div>
</template>
<script>
export default {

}
</script>
<style scoped>
.grid-item {
  position: relative;
}
.grid-item label {
  color: #46baba;
  display: inline-block;
  font-size: 18px;
  font-weight: bold;
  line-height: 1;
}
</style>