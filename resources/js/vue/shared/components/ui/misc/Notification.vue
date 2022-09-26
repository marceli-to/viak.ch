<template>
  <div :class="[type == 'toast' ? 'is-toast' : 'is-modal', style]" v-if="isOpen" @click="hide()">
    <div>
      
      <template v-if="type == 'alert'">
        <icon-cross />
        <div class="message" v-html="message"></div>
        <div class="actions">
          <a href="javascript:;" @click="hide()">Schliessen</a>
        </div>
      </template>

      <template v-if="type == 'toast'">
        <div class="message" v-html="message"></div>
      </template>

<!-- 
<template v-else>
  <template v-if="$slots.message">
    <div class="message">
      <slot name="message" />
    </div>
  </template>
  <template v-if="$slots.actions">
    <div class="actions">
      <slot name="actions" />
    </div>
  </template>
</template>
-->
    </div>
  </div>
</template>
<script>
import IconCross from "@/shared/components/ui/icons/Cross.vue";
import i18n from "@/shared/mixins/i18n";

export default {

  components: {
    IconCross,
  },

  mixins: [i18n],

  data() {
    return {
      
      // Message [String]
      message: null,

      // Type [String: 'alert', 'toast']
      type: 'alert',

      // Style [String]
      style: '',

      // Autohide [Boolean]
      autohide: true,

      // State [Boolean]
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

    if (this.autohide) {
      setTimeout(() => {
        this.hide();
      }, 2000);
    }

  },

  methods: {

    init(opts) {

      if (opts.message) {
        this.setMessage(this.__(opts.message));
      }

      if (opts.type) {
        this.setType(opts.type);
      }

      if (opts.style) {
        this.setStyle(opts.style);
      }

      if (opts.autohide) {
        this.setAutoHide(opts.autohide);
      }

      this.show();
    },

    show() {
      this.isOpen = true;
    },

    hide() {
      this.isOpen = false;
    },

    setMessage(message) {
      this.message = message;
    },

    setType(type) {
      this.type = type;
    },
    
    setStyle(style) {
      if (style == 'success') {
        this.style = 'notification is-success'
      }
      else if (style == 'error') {
        this.style = 'notification is-error'
      }
      else {
        this.style = 'notification is-info'
      }
    },

    setAutoHide(autohide) {
      this.autohide = autohide;
    }
  },

}
</script>