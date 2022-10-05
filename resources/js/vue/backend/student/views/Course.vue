<template>
  <div v-if="isFetched">
    <article-text class="content-text--event">
      <template #aside>
        <h1 class="xs:hide">{{ data.event.course.title }}</h1>
        <h2 class="xs:hide">{{ data.event.course.subtitle }}</h2>
        <div class="sm:mt-5x md:mt-10x">
          <router-link :to="{ name: 'student-profile' }" class="icon-arrow-right:below" :title="__('Zurück')">
            <span>{{ __('Zurück') }}</span>
            <icon-arrow-right />
          </router-link>
        </div>
      </template>
      <template #content>
        <h1 class="sm:hide">{{ data.event.course.title }}</h1>
        <h2 class="sm:hide">{{ data.event.course.subtitle }}</h2>
        <div class="mt-4x sm:mt-0" v-html="data.event.course.text"></div>
      </template>
    </article-text>

    <collapsible-container>
      <collapsible :expanded="true">
        <template #title>
          {{ __('Informationen') }}
        </template>
        <template #content>
          <stacked-list-event :event="data.event" :booking="data.booking">
            <template #action>
              <a href="" class="btn-secondary btn-auto-w" @click.prevent="confirm(data.uuid, data.booking)">
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
          {{ __('Dokumente') }}
        </template>
        <template #content>
          <stacked-list-item v-for="(file, index) in data.files" :key="index">
            <list-item-file :file="file" />
          </stacked-list-item>
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
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";
import IconCheckmark from "@/shared/components/ui/icons/Checkmark.vue";
import Messages from "@/shared/modules/messages/Index.vue";

export default {

  components: {
    NProgress,
    ArticleText,
    StackedListEvent,
    StackedListItem,
    CollapsibleContainer,
    Collapsible,
    IconArrowRight,
    IconCheckmark,
    ListItemFile,
    Messages
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
  