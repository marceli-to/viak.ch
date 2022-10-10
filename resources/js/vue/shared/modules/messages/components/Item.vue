<template>
  <div>

    <template>
      <stacked-list-item>
        <div>
          <div class="sm:hide mb-2x">{{ $props.message.date }} – {{ $props.message.user }}</div>
          <div class="sm:span-2 mb-1x xs:hide">{{ $props.message.date }}</div>
          <div class="sm:span-3 mb-1x xs:hide">{{ $props.message.user }}</div>
          <div class="sm:span-4 md:span-5 mb-1x">{{ $props.message.body | truncate(35, '...')  }}</div>
          <div class="sm:span-3 md:span-2 xs:mt-6x">
            <a href="javascript:;" class="btn-primary btn-auto-w" @click.prevent="show()">Anzeigen</a>
          </div>
        </div>
      </stacked-list-item>
    </template>

    <template v-if="isOpen">
      <div class="message is-visible">
        <a
          href="javascript:;"
          class="icon-lightbox-close"
          @click.prevent="hide()"
        >
          <icon-cross />
        </a>

        <div class="message__inner">
          <header>
            <div class="mb-1x">
              <div class="span-2 text-xsmall">{{ __('Datum') }}</div>
              <div class="span-10 text-xsmall">{{ $props.message.date }}</div>
            </div>
            <div class="mb-1x">
              <div class="span-2 text-xsmall">{{ __('Absender') }}</div>
              <div class="span-10 text-xsmall">{{ $props.message.user }}</div>
            </div>
          </header>
          <p v-if="$props.message.subject">
            {{ $props.message.subject }}
          </p>
          <p v-html="nl2br($props.message.body)"></p>
          <footer v-if="$props.message.files && $props.message.files.length > 0">
            <div class="text-xsmall mb-1x">
              {{ __('Anhänge') }}
            </div>
            <a :href="`/storage/uploads/${file.name}`" 
              v-for="(file, index) in $props.message.files" 
              :key="index"
              target="_blank">
              {{ file.name }}
              <!--, {{ file.size | fileSize() }} -->
            </a>
          </footer>
        </div>
      </div>
    </template>
  </div>
</template>
<script>
import StackedListItem from "@/shared/components/ui/layout/StackedListItem.vue";
import IconCross from "@/shared/components/ui/icons/Cross.vue";
import i18n from "@/shared/mixins/i18n";
import Helpers from "@/shared/mixins/Helpers";

export default {
  
  components: {
    StackedListItem,
    IconCross
  },
  
  mixins: [i18n, Helpers],

  data() {
    return {
      isOpen: false,
    }
  },

  mounted() {
    window.addEventListener("keyup", event => {
      if (event.which === 27) {
        this.hide();
      }
    });
  },

  props: {
    message: {
      type: Object,
      default: null
    },
  },

  methods: {
    show() {
      this.isOpen = true;
      setTimeout(() => {
        this.addListeners();
      }, 50)
    },

    hide() {
      this.isOpen = false;
    },

    addListeners() {
      const message = document.querySelector('.message.is-visible');

      // Handle outside click
      message.addEventListener('click', ($event) => { 
        const message_inner = document.querySelector('.message.is-visible > div');
        if ($event.target.contains(message_inner) && event.target !== message_inner) {
          this.hide();
        }
      }, false);

    }
  }
}
</script>