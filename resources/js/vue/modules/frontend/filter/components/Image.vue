<template>
  <picture>
    <img 
      :data-src="`/img/cache/${$props.image.name}/700/${$props.image.coords}/1x1`"
      src="/media/viak-placeholder-teaser.png"
      width="600" 
      height="600" 
      title="" 
      alt="Storytelling – Workshop" 
      class="is-responsive lazy"> 
    <source 
      media="(min-width: 700px)" 
      :data-srcset="`/img/cache/${$props.image.name}/1100/${$props.image.coords}/1x1`" 
      class="is-responsive lazy">
  </picture>
</template>
<script>
import LazyLoad from "vanilla-lazyload";
export default {

  props: {
    image: {
      type: Object,
      default: null,
    },
  },

  mounted() {
    let lazyLoadInstance = new LazyLoad();
  }
}
</script>