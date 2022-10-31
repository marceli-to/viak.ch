<template>
<div v-if="isLoaded">
  <content-list-header>
    <grid class="grid-cols-12">
      <grid-col class="span-4">
        <h1>Veranstaltungen für<br>{{ data.course.title.de }}</h1>
        <back-link :route="'courses'"></back-link>
      </grid-col>
    </grid>
  </content-list-header>

  <collapsible-container>
    <collapsible :expanded="true" :uuid="`course-events-upcoming`">
      <template #title>
        Bevorstehende Veranstaltungen
      </template>
      <template #content>
        <template v-if="data.events.upcoming.length > 0">
          <div v-for="event in data.events.upcoming" :key="event.id" class="relative">
            <stacked-list-event :event="event" :dashboard="true">
              <template #action>
                <router-link :to="{ name: 'event-edit', params: { uuid: event.uuid, referrer: 'events' } }" class="btn-primary mb-3x">
                  Bearbeiten
                </router-link>
                <router-link :to="{ name: 'event-show', params: { uuid: event.uuid, referrer: 'events' } }" class="btn-secondary">
                  Details
                </router-link>
              </template>
            </stacked-list-event>
          </div>
        </template>
        <template v-else>
          <p class="no-results">Es sind keine Veranstaltungen vorhanden.</p>
        </template>
      </template>
    </collapsible>

    <collapsible :uuid="`course-events-past`">
      <template #title>
        Vergangene Veranstaltungen
      </template>
      <template #content>
        <template v-if="data.events.past.length > 0">
          <div v-for="event in data.events.past" :key="event.id" class="relative">
            <stacked-list-event :event="event" :dashboard="true">
              <template #action>
                <router-link :to="{ name: 'event-edit', params: { uuid: event.uuid, referrer: 'events' } }" class="btn-primary mb-3x" v-if="!event.is_closed""">
                  Bearbeiten
                </router-link>
                <router-link :to="{ name: 'event-show', params: { uuid: event.uuid, referrer: 'events' } }" class="btn-secondary">
                  Details
                </router-link>
              </template>
            </stacked-list-event>
          </div>
        </template>
        <template v-else>
          <p class="no-results">Es sind keine Veranstaltungen vorhanden.</p>
        </template>
      </template>
    </collapsible>

    <collapsible :uuid="`course-events-cancelled`">
      <template #title>
        Abgesagte Veranstaltungen
      </template>
      <template #content>
        <template v-if="data.events.cancelled.length > 0">
          <div v-for="event in data.events.cancelled" :key="event.id" class="relative">
            <stacked-list-event :event="event" :dashboard="true"></stacked-list-event>
          </div>
        </template>
        <template v-else>
          <p class="no-results">Es sind keine Veranstaltungen vorhanden.</p>
        </template>
      </template>
    </collapsible>

  </collapsible-container>
</div>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import Helpers from "@/shared/mixins/Helpers";
import i18n from "@/shared/mixins/i18n";
import ContentListHeader from "@/shared/components/ui/layout/ContentListHeader.vue";
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
import BackLink from '@/shared/components/ui/misc/BackLink.vue';

export default {

  components: {
    NProgress,
    ErrorHandling,
    ContentListHeader,
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
    GridCol,
    BackLink
  },

  mixins: [ErrorHandling, Helpers, i18n],

  data() {
    return {

      data: {
        course: {},
        events: {
          past: [],
          upcoming: [],
        },
      },
  
      // Routes
      routes: {
        get: '/api/dashboard/events',
        store: '/api/dashboard/course',
        delete: '/api/dashboard/course',
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
      this.axios.get(`${this.routes.get}/${this.$route.params.courseUuid}`).then(response => {
        this.data.course = response.data.course;
        this.data.events.upcoming = response.data.upcoming;
        this.data.events.past = response.data.past;
        this.data.events.cancelled = response.data.cancelled;
        this.isLoaded = true;
        NProgress.done();
      });
    },
  },

}
</script>