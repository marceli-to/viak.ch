<template>
<div v-if="isLoaded">
  <content-list-header>
    <grid class="grid-cols-12">
      <grid-col class="span-4">
        <h1>Team</h1>
      </grid-col>
      <grid-col class="span-4">
        <router-link :to="{ name: 'team-member-create' }" class="icon-plus">
          <icon-plus />
        </router-link>
      </grid-col>
    </grid>
  </content-list-header>
  <draggable 
    :disabled="false"
    v-model="data" 
    @end="order"
    ghost-class="draggable-ghost"
    draggable=".is-draggable">
    <stacked-list-item v-for="teamMember in data" :key="teamMember.uuid" class="relative is-draggable">
      <router-link :to="{ name: 'team-member-edit', params: { id: teamMember.id } }" class="icon-edit mt-3x">
        <icon-edit />
      </router-link>
      <div>
        <div :class="[!teamMember.publish ? 'is-hidden' : '', 'span-4']">
          {{ teamMember.firstname }} {{ teamMember.name }}
        </div>
      </div>
    </stacked-list-item>
  </draggable>
  <notification ref="notification" />
</div>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import draggable from 'vuedraggable';
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
    ErrorHandling,
    draggable,
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
        get: '/api/dashboard/team-members',
        order: '/api/dashboard/team-members/order'
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

    order() {
      let items = this.data.map(function(item, index) {
        item.order = index;
        return item;
      });
      if (this.debounce) return;
      this.debounce = setTimeout(function(items) {
        this.debounce = false;
        this.axios.post(this.routes.order, {items: items}).then((response) => {
          this.$refs.notification.init({
            message: 'Reihenfolge angepasst',
            type: 'toast',
            style: 'success',
          });
        });
      }.bind(this, items), 1000);
    },

  },

}
</script>