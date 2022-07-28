<template>
  <div class="search-container">
    <div>
      <a href="" @click.prevent="$emit('clear')" v-if="$props.input">
        <icon-cross :size="'sm'" />
      </a>
      <slot />
    </div>
  </div>
</template>
<script>
import IconCross from "@/shared/components/ui/icons/Cross.vue";
export default {
  components: {
    IconCross
  },

  props: {
    input: {
      type: Boolean,
      default: false
    }
  }

}
</script>
