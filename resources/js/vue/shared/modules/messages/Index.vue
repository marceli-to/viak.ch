<template>
  <div v-if="isFetched">
    <div v-if="$props.messages.length">
      <stacked-list-item 
        v-for="(message, index) in $props.messages" 
        :key="index">
        <div>
          <div class="span-2">{{ message.date }}</div>
          <div class="span-2">{{ message.user }}</div>
          <div class="span-6">{{ message.subject }}</div>
        </div>
      </stacked-list-item>
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
import StackedListItem from "@/shared/components/ui/layout/StackedListItem.vue";
import IconPlus from "@/shared/components/ui/icons/Plus.vue";

export default {

  components: {
    NProgress,
    StackedListItem,
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

  // mounted() {
  //   this.fetch();
  // },

  // methods: {
  //   fetch() {
  //     this.axios.get(`${this.routes.get}/${this.$props.eventUuid}`).then(response => {
  //       this.data = response.data.data;
  //       this.isFetched = true;
  //     });
  //   },
  // }
}

</script>