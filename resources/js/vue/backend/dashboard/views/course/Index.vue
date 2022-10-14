<template>
<div v-if="isLoaded">
  <content-list-header>
    <grid class="grid-cols-12">
      <grid-col class="span-4">
        <h1>Kurse</h1>
      </grid-col>
      <grid-col class="span-4">
        <router-link :to="{ name: 'course-create' }" class="icon-plus">
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
    <draggable 
      :disabled="false"
      v-model="data" 
      @end="order"
      ghost-class="draggable-ghost"
      draggable=".is-draggable">
      <collapsible v-for="course in queryData" :key="course.id" :class="[!course.publish ? 'is-hidden' : '', 'is-draggable']" :uuid="`course-events-${course.uuid}`">
        <template #title>
          {{ course.course_number }} <span>{{ course.title }}</span>
        </template>
        <template #action>
          <router-link 
            :to="{ name: 'course-edit', params: { id: course.id } }" 
            class="icon-edit icon-edit--course">
            <icon-edit />
          </router-link>
        </template>
        <template #content>
          <template v-if="course.count > 0">
            <div v-for="event in course.events" :key="event.id" class="relative">
              <stacked-list-event :event="event" :dashboard="true">
                <template #action>
                  <router-link :to="{ name: 'event-edit', params: { uuid: event.uuid } }" class="btn-primary mb-3x">
                    Bearbeiten
                  </router-link>
                  <router-link :to="{ name: 'event-show', params: { uuid: event.uuid } }" class="btn-secondary">
                    Details
                  </router-link>
                </template>
              </stacked-list-event>
            </div>
          </template>
          <template v-else>
            <p class="no-results">Es sind keine Veranstaltungen vorhanden.</p>
          </template>
          <div class="flex justify-start mt-6x">
            <router-link :to="{ name: 'event-create', params: { courseId: course.id }  }" class="icon-plus">
              <icon-plus />
            </router-link>
          </div>
        </template>
      </collapsible>
    </draggable>
  </collapsible-container>
  <notification ref="notification" />
</div>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import draggable from 'vuedraggable';
import ContentListHeader from "@/shared/components/ui/layout/ContentListHeader.vue";
import SearchContainer from "@/shared/components/ui/form/Search.vue";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
import StackedListContainer from "@/shared/components/ui/layout/StackedListContainer.vue";
import StackedListItem from "@/shared/components/ui/layout/StackedListItem.vue";
import StackedListHeader from "@/shared/components/ui/layout/StackedListHeader.vue";
import StackedListFooter from "@/shared/components/ui/layout/StackedListFooter.vue";
import StackedListEvent from "@/shared/components/ui/layout/StackedListEvent.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import IconEdit from "@/shared/components/ui/icons/Edit.vue";
import IconPlus from "@/shared/components/ui/icons/Plus.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";

export default {

  components: {
    NProgress,
    ErrorHandling,
    draggable,
    ContentListHeader,
    SearchContainer,
    StackedListContainer,
    StackedListItem,
    StackedListHeader,
    StackedListFooter,
    StackedListEvent,
    CollapsibleContainer,
    Collapsible,
    IconEdit,
    IconPlus,
    IconArrowRight,
    Grid,
    GridCol
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
        order: '/api/dashboard/course/order'
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
      let courses = this.queryData.map(function(course, index) {
        course.order = index;
        return course;
      });
      if (this.debounce) return;
      this.debounce = setTimeout(function(courses) {
        this.debounce = false;
        this.axios.post(this.routes.order, {courses: courses}).then((response) => {
          this.$refs.notification.init({
            message: 'Reihenfolge angepasst',
            type: 'toast',
            style: 'success',
          });
        });
      }.bind(this, courses), 1000);
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