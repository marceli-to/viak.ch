<template>
<div v-if="isLoaded">
  <content-list-header>
    <grid class="grid-cols-12">
      <grid-col class="span-4">
        <h1>Hero Bilder</h1>
      </grid-col>
      <!-- <grid-col class="span-4">
        <router-link :to="{ name: 'content-hero-create' }" class="icon-plus">
          <icon-plus />
        </router-link>
      </grid-col> -->
    </grid>
  </content-list-header>

  
  <collapsible-container>
    <collapsible :expanded="true" v-for="hero in data" :key="hero.uuid">
      <template #title>{{ hero.title }}</template>
      <template #content>
        <images 
          :imageRatioW="16" 
          :imageRatioH="9"
          :type="'Hero'"
          :typeId="hero.id"
          :hasTypes="false"
          :allowRatioSwitch="false"
          :previewItemClass="'!span-3'"
          :images="hero.images">
        </images>
      </template>
    </collapsible>
  </collapsible-container>


  <notification ref="notification" />
</div>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
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
import Images from "@/shared/modules/images/Index.vue";


export default {

  components: {
    NProgress,
    ErrorHandling,
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
    IconPlus,
    Images
  },

  mixins: [],

  data() {
    return {

      data: [],

      // Routes
      routes: {
        get: '/api/dashboard/heroes',
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