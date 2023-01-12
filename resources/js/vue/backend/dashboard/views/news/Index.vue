<template>
<div v-if="isLoaded">
  <content-list-header>
    <grid class="grid-cols-12">
      <grid-col class="span-4">
        <h1>News</h1>
      </grid-col>
      <grid-col class="span-4">
        <router-link :to="{ name: 'content-news-create' }" class="icon-plus">
          <icon-plus />
        </router-link>
      </grid-col>
    </grid>
  </content-list-header>
  <stacked-list-item v-for="news in data" :key="news.uuid" class="relative">
    <router-link :to="{ name: 'content-news-edit', params: { id: news.id } }" class="icon-edit mt-3x">
      <icon-edit />
    </router-link>
    <div>
      <div :class="[!news.publish ? 'is-hidden' : '', 'span-8']">
        {{ news.title.de }} <span class="text-xsmall">(Erstellt am: {{ news.created_at }})</span>
      </div>
    </div>
  </stacked-list-item>
</div>
</template>
<script>
import NProgress from 'nprogress';
import ContentListHeader from "@/shared/components/ui/layout/ContentListHeader.vue";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
import SearchContainer from "@/shared/components/ui/form/Search.vue";
import StackedListContainer from "@/shared/components/ui/layout/StackedListContainer.vue";
import StackedListItem from "@/shared/components/ui/layout/StackedListItem.vue";
import StackedListHeader from "@/shared/components/ui/layout/StackedListHeader.vue";
import StackedListFooter from "@/shared/components/ui/layout/StackedListFooter.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import IconEdit from "@/shared/components/ui/icons/Edit.vue";
import IconPlus from "@/shared/components/ui/icons/Plus.vue";

export default {

  components: {
    NProgress,
    Grid,
    GridCol,
    ContentListHeader,
    SearchContainer,
    StackedListContainer,
    StackedListItem,
    StackedListHeader,
    StackedListFooter,
    CollapsibleContainer,
    Collapsible,
    IconEdit,
    IconPlus
  },

  mixins: [],

  data() {
    return {

      data: [],

      // Routes
      routes: {
        get: '/api/dashboard/news-items',
      },

      // States
      isLoaded: false,

      // Messages
      messages: {
        emptyData: 'Es sind noch keine Daten vorhanden...',
        confirm: 'Bitte löschen bestätigen.',
        updated: 'Daten aktualisiert',
      }
    };
  },

  created() {
    this.fetch();
  },

  methods: {

    fetch() {
      NProgress.start();
      this.isLoaded = false;
      this.axios.get(`${this.routes.get}`).then(response => {
        this.data = response.data.data;
        this.isLoaded = true;
        NProgress.done();
      });
    },
  },

}
</script>