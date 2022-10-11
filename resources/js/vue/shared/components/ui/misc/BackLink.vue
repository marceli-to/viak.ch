<template>
  <div class="sm:mt-5x md:mt-10x">
    <router-link :to="{ name: `${$props.route}` }" class="icon-arrow-left:below">
      <span>{{ __('Zurück') }}</span>
      <icon-arrow-left />
    </router-link>
  </div>
</template>
<script>
import i18n from "@/shared/mixins/i18n";
import IconArrowLeft from "@/shared/components/ui/icons/ArrowLeft.vue";

export default {

  components: {
    IconArrowLeft
  },

  mixins: [i18n],
  
  props: {
    route: {
      type: String,
      default: null,
    }
  }
}
</script>