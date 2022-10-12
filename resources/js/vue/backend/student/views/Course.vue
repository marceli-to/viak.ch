<template>
  <div v-if="isFetched">
    <article-text class="content-text--event">
      <template #aside>
        <h1 class="xs:hide">{{ data.event.course.title }}</h1>
        <back-link :route="'student-profile'"></back-link>
      </template>
    </article-text>

    <collapsible-container>
      <collapsible :expanded="true">
        <template #title>
          {{ __('Buchung') }}
        </template>
        <template #content>
          <stacked-list-event :event="data.event" :booking="data.booking">
            <template #action>
              <a href="" class="btn-secondary btn-auto-w" @click.prevent="confirm(data.booking.uuid, data.booking)">
                {{ __('Annullieren') }}
              </a>
            </template>
          </stacked-list-event>
        </template>
      </collapsible>
    </collapsible-container>

    <collapsible-container>
      <collapsible :items="data.messages">
        <template #title>
          {{ __('Nachrichten') }}
        </template>
        <template #content>
          <messages 
            :messages="data.messages" 
            :eventUuid="data.event.uuid">
          </messages>
        </template>
      </collapsible>
    </collapsible-container>

    <collapsible-container>
      <collapsible :items="data.files">
        <template #title>
          {{ __('Kurs-Dokumente') }}
        </template>
        <template #content>
          <template v-if="data.files.length">
            <stacked-list-item v-for="(file, index) in data.files" :key="index">
              <list-item-file :file="file" />
            </stacked-list-item>
          </template>
          <template v-else>
            <p class="no-results">{{ __('Es sind keine Kurs-Dokumente vorhanden.') }}</p>
          </template>
        </template>
      </collapsible>
    </collapsible-container>

    <notification ref="notification">
      <template #actions>
        <a href="javascript:;" @click="cancel()" class="btn-primary">{{ __('Bestätigen') }}</a>
        <a href="javascript:;" @click="$refs.notification.hide()" class="btn-secondary">{{ __('Abbrechen') }}</a>
      </template>
    </notification>
  </div>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import Meta from "@/shared/mixins/Meta";
import i18n from "@/shared/mixins/i18n";
import Booking from "@/shared/mixins/Booking";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import StackedListEvent from "@/shared/components/ui/layout/StackedListEvent.vue";
import StackedListItem from "@/shared/components/ui/layout/StackedListItem.vue";
import ListItemFile from "@/shared/modules/files/components/ListItem.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import IconCheckmark from "@/shared/components/ui/icons/Checkmark.vue";
import Messages from "@/shared/modules/messages/Index.vue";
import BackLink from '@/shared/components/ui/misc/BackLink.vue';

export default {

  components: {
    NProgress,
    ArticleText,
    StackedListEvent,
    StackedListItem,
    CollapsibleContainer,
    Collapsible,
    IconCheckmark,
    ListItemFile,
    Messages,
    BackLink
  },

  mixins: [ErrorHandling, i18n, Booking, Meta],

  data() {
    return {

      data: [],

      isFetched: false,

      routes: {
        show: '/api/student/course/event',
        booking: {
          cancel: '/api/booking/cancel'
        }
      },
    };
  },

  mounted() {
    this.fetch();
  },

  methods: {

    fetch() {
      NProgress.start();
      this.isFetched = false;
      this.axios.get(`${this.routes.show}/${this.$route.params.uuid}`).then(response => {
        this.data = response.data;
        this.setTitle(this.data.event.course.title);
        this.isFetched = true;
        NProgress.done();
      });
    },

  },
}
</script>
  