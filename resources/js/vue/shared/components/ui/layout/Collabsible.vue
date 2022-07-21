<template>
  <div :class="[isOpen ? 'is-expanded' : '', 'collapsible mb-6x md:mb-6x']">
    <h2>
      <a href="" class="btn-collapsible" @click.prevent="toggle()">
        <slot name="title" />
      </a>
    </h2>
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