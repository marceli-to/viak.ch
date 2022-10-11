<template>
  <div :class="`form-danger-zone ${style}`">
    <slot name="content" />
  </div>
</template>
<script>
import i18n from "@/shared/mixins/i18n";

export default {
  
  mixins: [i18n],

  props: {
    type: {
      type: String,
      default: 'info'
    },
  },

  computed: {
    style() {
      if (this.$props.type == 'success') return 'is-success';
      if (this.$props.type == 'danger') return 'is-danger';
      if (this.$props.type == 'warning') return 'is-warning';
      return this.$props.type;
    }
  }
}
</script>