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
import Helpers from "@/shared/mixins/Helpers";

export default {

  components: {
    Count
  },

  mixins: [Helpers],

  data() {
    return {
      isOpen: false,
      collapsibles: [],
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
    },

    uuid: {
      type: String,
      default: null,
    }
  },

  mounted() {
    this.isOpen = this.$props.expanded ? true : false;
    console.log(this.isOpen);
    this.collapsibles = this.$store.state.collapsibles;

    if (this.findInState(this.$props.uuid)) {
      this.isOpen = true;
    }
  },

  methods: {

    toggle() {
      this.isOpen = this.isOpen ? false : true;
      this.updateState(this.$props.uuid);
    },

    show() {
      this.isOpen = true;
    },

    hide() {
      this.isOpen = false;
    },

    updateState(uid) {
      if (this.isOpen) {
        if (!this.collapsibles.includes(uid)) {
          this.collapsibles.push(uid);
          this.$store.commit('collapsibles', this.collapsibles);
        }
      }
      else {
        let index = this.collapsibles.findIndex((x) => x === uid);
        this.collapsibles.splice(index, 1);
        this.$store.commit('collapsibles', this.collapsibles);
      }
    },

    findInState(uid) {
      return this.collapsibles.includes(uid);
    }
  }
}
</script>
<style scoped>
  .btn-collapsible {
    padding-bottom: 6px;
  }
</style>