<template>
<div v-if="isLoaded">

  <content-list-header>
    <grid class="grid-cols-12">
      <grid-col class="span-4">
        <h1>Rabatt-Codes</h1>
      </grid-col>
      <grid-col class="span-4">
        <router-link :to="{ name: 'discount-code-create' }" class="icon-plus">
          <icon-plus />
        </router-link>
      </grid-col>
      <grid-col class="span-4">
        <search-container @clear="searchQuery = null" :input="searchQuery ? true : false">
          <input type="text" v-model="searchQuery" maxlength="" placeholder="Suchbegriff..." />
        </search-container>
      </grid-col>
    </grid>
  </content-list-header>


  <collapsible-container>
    <collapsible :expanded="true">
      <template #title>Gültige Rabatt-Codes</template>
      <template #content>
        <stacked-list-item v-for="discountCode in queryData" :key="discountCode.id" class="relative">
          <router-link :to="{ name: 'discount-code-edit', params: { id: discountCode.id } }" class="icon-edit mt-3x">
            <icon-edit />
          </router-link>
          <div>
            <div class="span-4">
              {{ discountCode.code }}
            </div>
          </div>
        </stacked-list-item>
      </template>
    </collapsible>
  </collapsible-container>
</div>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import SearchContainer from "@/shared/components/ui/form/Search.vue";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
import ContentListHeader from "@/shared/components/ui/layout/ContentListHeader.vue";
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
    IconPlus
  },

  mixins: [],

  data() {
    return {

      data: [],

      searchQuery: null,

      // Routes
      routes: {
        get: '/api/dashboard/discount-codes',
      },

      // States
      isLoaded: false,

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

  computed: {
    queryData() {
      if (this.searchQuery) {
        return this.data.filter((item) => {
          return this.searchQuery.toLowerCase().split(' ').every(
            v => item.code.toLowerCase().includes(v)
          )
        })
      }
      else {
        return this.data;
      }
    }
  }
}
</script>