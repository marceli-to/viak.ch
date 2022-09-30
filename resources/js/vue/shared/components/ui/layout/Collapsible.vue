<template>
  <div :class="[isOpen ? 'is-expanded' : '', 'collapsible relative']">
    <h2>
      <a href="" class="btn-collapsible" @click.prevent="toggle()">
        <slot name="title" />
        <count :count="$props.items.length" v-if="$props.items && $props.items.length > 0 && !isOpen" />
      </a>
    </h2>
    <template v-if="$slots.action && !isOpen">
      <slot name="action" />
    </template>
    <div v-show="isOpen">
      <slot name="content" />
    </div>
  </div>
</template>
<script>
import Count from "@/shared/components/ui/misc/Count.vue";

export default {

  components: {
    Count
  },

  data() {
    return {
      isOpen: false,
    }
  },

  props: {
    expanded: {
      type: [Boolean, Number],
      default: false,
    },

    items: {
      type: [Array, Object],
      default: null,
    }
  },

  mounted() {
    this.isOpen = this.$props.expanded ? true : false;
  },

  methods: {

    toggle() {
      this.isOpen = this.isOpen ? false : true;
    },

    show() {
      this.isOpen = true;
    },

    hide() {
      this.isOpen = false;
    }
  }
}
</script>
<style scoped>
  .btn-collapsible {
    padding-bottom: 6px;
  }
</style>