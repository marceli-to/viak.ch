<template>
  <div v-if="isFetched">
    <div v-if="$props.messages.length">
      <message-list-item v-for="(message, index) in $props.messages" :key="index" :message="message"></message-list-item>
    </div>
    <div v-else>
      <p class="no-results">Es sind keine Nachrichten vorhanden.</p>
    </div>
    <div class="flex justify-start mt-6x">
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
import MessageListItem from "@/shared/modules/messages/components/List.vue";
import IconPlus from "@/shared/components/ui/icons/Plus.vue";

export default {

  components: {
    NProgress,
    MessageListItem,
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