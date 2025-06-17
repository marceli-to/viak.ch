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

  <div class="mt-8x">
    <a 
      href="javascript:;" 
      class="btn-switcher"
      @click="toggleSortMode">
      <icon-arrow-switcher />
      <span>
        {{ sortMode === 'chronological' ? __('Kurse') : __('Veranstaltungen') }}
      </span>
    </a>
  </div>

  <template v-if="sortMode === 'chronological'">
    <stacked-list-item
      v-for="event in sortedEvents"
      :key="event.uuid"
      class="relative stacked-list-item--course-events">
      <router-link :to="{ name: 'event-edit', params: { uuid: event.uuid } }" class="icon-edit mt-3x">
        <icon-edit />
      </router-link>
      <router-link :to="{ name: 'event-show', params: { uuid: event.uuid } }"  class="icon-arrow-right is-absolute">
        <icon-arrow-right />
      </router-link>
      <div>
        <div class="span-2">
          <strong>{{ event.dates?.[0]?.date_long || event.date }}</strong>
          <br>{{ event.dates?.[0]?.time_start }} – {{ event.dates?.[0]?.time_end }} {{ __('Uhr') }}
        </div>
        <div class="span-6">
          <h2><em>{{ event.courseNumber }}</em><span>{{ event.courseTitle }}</span></h2>
          <template v-if="event.online">
            {{ __('Onlinekurs') }}
          </template>
          <template v-else-if="event.location && event.location.description">
              <a :href="event.location.map" target="_blank" :title="__('Karte öffnen')" v-if="event.location.map">
                {{ event.location.description }}
              </a>
              <span v-else>
                {{ event.location.description }}
              </span>
          </template>
          <template v-if="event.experts">
            ({{ event.experts }})
          </template>
          <event-state :event="event" :dashboard="true" />
        </div>
        <div class="span-4">
          <div :class="[event.bookings >= event.max_participants ? 'text-success' : '', '']">
            {{ event.bookings }}&thinsp;/&thinsp;{{ event.max_participants }} Teilnehmer
          </div>
          <template v-if="event.rentals_available">
            {{ event.rentals_booked }}&thinsp;/&thinsp;{{ event.rentals_available }} Mietcomputer
          </template>
        </div>
      </div>
    </stacked-list-item>
  </template>

  <template v-if="sortMode === 'custom'">
    <collapsible-container class="is-course-events">
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
            <div class="flex justify-between mt-6x">
              <router-link :to="{ name: 'event-create', params: { courseId: course.id }  }" class="icon-plus">
                <icon-plus />
              </router-link>
              <router-link :to="{ name: 'events', params: { courseUuid: course.uuid }  }" class="icon-arrow-right">
                <icon-arrow-right />
              </router-link>
            </div>
          </template>
        </collapsible>
      </draggable>
    </collapsible-container>
  </template>

</div>
</template>
<script>
import NProgress from 'nprogress';
import Helpers from "@/shared/mixins/Helpers";
import i18n from "@/shared/mixins/i18n";
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
import EventState from "@/shared/components/ui/misc/EventState";
import IconEdit from "@/shared/components/ui/icons/Edit.vue";
import IconPlus from "@/shared/components/ui/icons/Plus.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";
import IconArrowSwitcher from "@/shared/components/ui/icons/ArrowSwitcher.vue";

export default {

  components: {
    NProgress,
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
    EventState,
    IconEdit,
    IconPlus,
    IconArrowRight,
    IconArrowSwitcher,
    Grid,
    GridCol
  },

  mixins: [Helpers, i18n],

  data() {
    return {

      data: [],

      searchQuery: null,
      sortMode: 'chronological', // or 'custom'

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
          this.$toast.open(this.__('Reihenfolge angepasst'));
        });
      }.bind(this, courses), 1000);
    },

    toggleSortMode() {
      this.sortMode = this.sortMode === 'chronological' ? 'custom' : 'chronological';
    }
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
    },

    sortedEvents() {
      let eventsList = this.data.flatMap(course => {
        //const events = Array.isArray(course.events) ? course.events : [];
        const events = Object.values(course.events || {});
        return events.map(event => ({
          ...event,
          courseTitle: course.title,
          courseId: course.id,
          courseUuid: course.uuid,
          courseNumber: course.course_number
        }));
      });

      // Apply search filter
      if (this.searchQuery) {
        const query = this.searchQuery.toLowerCase().trim();
        const terms = query.split(' ');

        eventsList = eventsList.filter(event => {
          return terms.every(term =>
            (event.courseNumber?.toLowerCase() ?? '').includes(term) ||
            (event.courseTitle?.toLowerCase() ?? '').includes(term) ||
            (event.experts?.toLowerCase() ?? '').includes(term) ||
            (event.location?.description?.toLowerCase() ?? '').includes(term) ||
            (event.dates?.some(d => (d.date_long ?? '').toLowerCase().includes(term)) ?? false)
          );
        });
      }

      // Sort by first date (or fallback to event.date)
      return eventsList.sort((a, b) => {
        const dateA = new Date(a.dates?.[0]?.date || a.date);
        const dateB = new Date(b.dates?.[0]?.date || b.date);
        return dateA - dateB;
      });
    }
  }
}
</script>