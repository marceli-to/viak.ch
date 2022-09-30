<template>
  <div v-if="isFetched">
    <stacked-list-item 
      v-for="(message, index) in data" 
      :key="index">
      <div>
        <div class="span-2">{{ message.date }}</div>
        <div class="span-6">{{ message.subject }}</div>
      </div>
    </stacked-list-item>
  </div>
</template>
<script>
import NProgress from 'nprogress';
import Helpers from "@/shared/mixins/Helpers";
import i18n from "@/shared/mixins/i18n";
import StackedListItem from "@/shared/components/ui/layout/StackedListItem.vue";

export default {

  components: {
    NProgress,
    StackedListItem
  },

  mixins: [Helpers, i18n],

  props: {
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
      isFetched: false,
      isLoading: false,
    };
  },

  mounted() {
    this.fetch();
  },

  methods: {
    fetch() {
      this.axios.get(`${this.routes.get}/${this.$props.eventUuid}`).then(response => {
        this.data = response.data.data;
        this.isFetched = true;
      });
    },
  }
}

</script>