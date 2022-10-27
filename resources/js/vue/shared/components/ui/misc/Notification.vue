<template>
  <div 
    :class="`is-modal ${style}`" 
    v-show="isOpen" 
    @click="hide()">
    <div class="notification__inner">

      <template v-if="type == 'alert'">
        <div class="notification-icon">
          <icon-cross />
        </div>
        <div class="notification-message" v-html="message"></div>
        <div class="notification-actions">
          <a href="javascript:;" @click="hide()">Schliessen</a>
        </div>
      </template>

      <template v-if="type == 'dialog'">
        <div class="notification-message" v-html="message"></div>
        <template v-if="$slots.actions">
          <div class="notification-actions">
            <slot name="actions" />
          </div>
        </template>
        <template v-else>
          <div class="notification--actions">
            <a href="javascript:;" @click="hide()">Schliessen</a>
          </div>
        </template>
      </template>

    </div>
  </div>
</template>
<script>
import IconCross from "@/shared/components/ui/icons/Cross.vue";
import IconCheckmark from "@/shared/components/ui/icons/Checkmark.vue";
import i18n from "@/shared/mixins/i18n";

export default {

  components: {
    IconCross,
    IconCheckmark,
  },

  mixins: [i18n],

  data() {
    return {
      
      // Message [String]
      message: null,

      // Type [String: 'alert', 'modal']
      type: 'alert',

      // Style [String]
      style: '',

      // Autohide [Boolean]
      autohide: false,
      
      autohideDelay: 2000,

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

      if (opts.autohide !== undefined) {
        this.setAutoHide(opts.autohide)
      }

      this.show();
    },

    show() {
     
      this.isOpen = true;
      if (this.autohide) {
        setTimeout(() => {
          this.hide();
        }, this.autohideDelay);
      }
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
    },

    addListeners() {
      const modal = document.querySelector('.notification.is-modal');

      // Handle outside click
      modal.addEventListener('click', ($event) => { 
        const inner = document.querySelector('.notification__inner');
        if ($event.target.contains(inner) && event.target !== inner) {
          this.hide();
        }
      }, false);
    }
  },

}
</script>