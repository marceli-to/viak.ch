<template>
  <div v-if="isFetched">
    <div v-if="$props.messages.length">
      <message-item 
        v-for="(message, index) in $props.messages" 
        :key="index" 
        :message="message" />
    </div>
    <div v-else>
      <p class="no-results">Es sind keine Nachrichten vorhanden.</p>
    </div>
    <div class="flex justify-start mt-6x" v-if="$props.canCreate">
      <router-link :to="{ name: 'expert-course-event-message' }" class="icon-plus">
        <icon-plus />
      </router-link>
    </div>
  </div>
</template>
<script>
import NProgress from 'nprogress';
import Helpers from "@/shared/mixins/Helpers";
import i18n from "@/shared/mixins/i18n";
import MessageItem from "@/shared/modules/messages/components/Item.vue";
import IconPlus from "@/shared/components/ui/icons/Plus.vue";

export default {

  components: {
    NProgress,
    MessageItem,
    IconPlus
  },

  mixins: [Helpers, i18n],

  props: {

    messages: {
      type: [Array, Object],
      default: null
    },

    eventUuid: {
      type: String,
      default: null,
    },

    canCreate: {
      type: Boolean,
      default: false
    }
  },

  data() {
    return {

      // Data
      data: null,

      // Routes
      routes: {
        get: '/api/messages',
      },

      // States
      isFetched: true,
      isLoading: false,
    };
  },

}

</script>