<template>
  <div :class="[isOpen ? 'is-expanded' : '', 'collapsible relative']">
    <h2>
      <a href="" class="btn-collapsible" @click.prevent="toggle()">
        <slot name="title" />
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
export default {
  data() {
    return {
      isOpen: false,
    }
  },

  props: {
    expanded: {
      type: [Boolean, Number],
      default: false,
    }
  },

  mounted() {
    this.isOpen = this.$props.expanded ? true : false;
  },

  created() {
    const onEscape = (e) => {
      if (this.isOpen && e.keyCode === 27) {
        this.hide();
      }
    }
    document.addEventListener('keydown', onEscape);
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