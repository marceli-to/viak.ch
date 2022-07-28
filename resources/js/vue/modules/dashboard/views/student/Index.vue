<template>
<div v-if="isLoaded">
  <content-list-header class="flex">
    <h1>Studenten</h1>
    <search-container @clear="searchQuery = null" :input="searchQuery ? true : false">
      <input type="text" v-model="searchQuery" maxlength="" placeholder="Suchbegriff..." />
    </search-container>
  </content-list-header>
  <collapsible-container>
    <collapsible :expanded="true">
      <template #title>Aktive Studenten</template>
      <template #content>
        <stacked-list-item v-for="student in queryData" :key="student.uuid" class="relative">
          <router-link :to="{ name: 'student-edit', params: { id: student.id } }" class="icon-edit mt-3x">
            <icon-edit />
          </router-link>
          <div>
            <div class="span-4">
              {{ student.fullname }}<span v-if="student.city">, {{ student.city }}</span>
            </div>
            <div class="span-8">
              <a :href="`mailto:${student.email}`" target="_blank">{{ student.email }}</a>
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
import StackedListContainer from "@/shared/components/ui/layout/StackedListContainer.vue";
import StackedListItem from "@/shared/components/ui/layout/StackedListItem.vue";
import StackedListHeader from "@/shared/components/ui/layout/StackedListHeader.vue";
import StackedListFooter from "@/shared/components/ui/layout/StackedListFooter.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import IconEdit from "@/shared/components/ui/icons/Edit.vue";

export default {

  components: {
    NProgress,
    ErrorHandling,
    ContentListHeader,
    SearchContainer,
    StackedListContainer,
    StackedListItem,
    StackedListHeader,
    StackedListFooter,
    CollapsibleContainer,
    Collapsible,
    IconEdit
  },

  mixins: [],

  data() {
    return {

      data: [],

      searchQuery: null,

      // Routes
      routes: {
        get: '/api/dashboard/students',
        store: '/api/dashboard/student',
        delete: '/api/dashboard/student',
        toggle: '/api/dashboard/student/state',
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
  computed: {
    queryData() {
      if (this.searchQuery) {
        return this.data.filter((item) => {
          return this.searchQuery.toLowerCase().split(' ').every(
            v => 
            item.firstname.toLowerCase().includes(v) || 
            item.name.toLowerCase().includes(v) || 
            (item.city && item.city.toLowerCase().includes(v)) ||
            item.email.toLowerCase().includes(v)
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