<template>
<div>
  <div class="flex justify-end items-center">
    <a href="" @click.prevent="$emit('deleteRow')">
      <icon-trash />
    </a>
  </div>
  <slot />
</div>
</template>
<script>
import NProgress from 'nprogress';
import IconTrash from "@/shared/components/ui/icons/Trash.vue";

export default {

  components: {
    IconTrash
  },

}
</script>
<style scoped>

.grid {
  display: grid;
  grid-gap: 32px;
  margin-bottom: 24px;
  margin-top: 12px;
}

.grid > div {
  border: 2px dashed #969696;
  min-height: 175px;
  font-size: 20px;
  padding: 6px 12px;
  position: relative
}

.grid-1-2 {
  grid-template-columns: 1fr 2fr;
}

.grid-2-1 {
  grid-template-columns: 2fr 1fr;
}
</style>