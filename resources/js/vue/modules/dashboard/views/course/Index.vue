<template>
<div v-if="isLoaded">
  <content-list-header class="flex">
    <h1>Kurse</h1>
    <search-container @clear="searchQuery = null" :input="searchQuery ? true : false">
      <input type="text" v-model="searchQuery" maxlength="" placeholder="Suchbegriff..." />
    </search-container>
  </content-list-header>
  <collapsible-container>
    <collapsible v-for="course in queryData" :key="course.uuid">
      <template #title>{{ course.course_number }} <span>{{ course.title }}</span></template>
      <template #action>
        <router-link 
          :to="{ name: 'course-edit', params: { id: course.id } }" 
          class="icon-edit icon-edit--course">
          <icon-edit />
        </router-link>
      </template>
      <template #content>
        <template v-if="course.events.length">
          <div v-for="event in course.events" :key="event.uuid" class="relative">
            <stacked-list-event :event="event" :dashboard="true">
              <template #action>
                <router-link :to="{ name: 'event-edit', params: { id: course.id, eventId: event.id } }" class="icon-edit mt-5x">
                  <icon-edit />
                </router-link>
              </template>
            </stacked-list-event>
          </div>
        </template>
        <template v-else>
          <em class="text-small text-danger block mt-3x">Keine Kurse vorhanden...</em>
        </template>
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
import StackedListEvent from "@/shared/components/ui/layout/StackedListEvent.vue";
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
    StackedListEvent,
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
        get: '/api/dashboard/courses',
        store: '/api/dashboard/course',
        delete: '/api/dashboard/course',
        toggle: '/api/dashboard/course/state',
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
            v => item.course_number.toLowerCase().includes(v) || item.title.toLowerCase().includes(v)
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