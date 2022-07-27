<template>
<div v-if="isLoaded">
  <content-list-header>
    <grid class="grid-cols-12">
      <grid-col class="span-4">
        <h1>Experten</h1>
      </grid-col>
      <grid-col class="span-8">
        <router-link :to="{ name: 'expert-create' }" class="icon-plus">
          <icon-plus />
        </router-link>
      </grid-col>
    </grid>
  </content-list-header>
  <collapsible-container>
    <collapsible :expanded="true">
      <template #title>Aktive Experten</template>
      <template #content>
        <stacked-list-item v-for="expert in data.active" :key="expert.uuid" class="relative">
          <router-link :to="{ name: 'expert-edit', params: { id: expert.id } }" class="icon-edit mt-3x">
            <icon-edit />
          </router-link>
          <div>
            <div class="span-4">
              {{ expert.fullname }}<span v-if="expert.city">, {{ expert.city }}</span>
            </div>
            <div class="span-8">
              <a :href="`mailto:${expert.email}`" target="_blank">{{ expert.email }}</a>
            </div>
          </div>
        </stacked-list-item>
      </template>
    </collapsible>
    <collapsible>
      <template #title>Inaktive Experten</template>
      <template #content>
        <stacked-list-item v-for="expert in data.inactive" :key="expert.uuid" class="relative">
          <router-link :to="{ name: 'expert-edit', params: { id: expert.id } }" class="icon-edit mt-3x">
            <icon-edit />
          </router-link>
          <div>
            <div class="span-4">
              <h2>{{ expert.fullname }}<span v-if="expert.city">, {{ expert.city }}</span></h2>
            </div>
            <div class="span-8">
              <a :href="`mailto:${expert.email}`" target="_blank">{{ expert.email }}</a>
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
import ContentListHeader from "@/shared/components/ui/layout/ContentListHeader.vue";
import SearchContainer from "@/shared/components/ui/form/Search.vue";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
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
    ContentListHeader,
    Grid,
    GridCol,
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

      data: {
        'active': [],
        'hidden': []
      },

      searchQuery: null,

      // Routes
      routes: {
        get: '/api/dashboard/experts',
        store: '/api/dashboard/expert',
        delete: '/api/dashboard/expert',
        toggle: '/api/dashboard/expert/state',
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
        this.data.active = response.data.active;
        this.data.inactive = response.data.inactive;
        this.isLoaded = true;
        NProgress.done();
      });
    },

    destroy(id) {
      if (confirm(this.messages.confirm)) {
        this.isLoaded = true;
        this.axios.delete(`${this.routes.delete}/${id}`).then(response => {
          this.fetch();
          this.isLoaded = false;
        });
      }
    },
  },

}
</script>