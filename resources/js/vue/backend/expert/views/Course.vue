<template>
  <div v-if="isFetched">
    <article-text class="content-text--event">
      <template #aside>
        <h1 class="xs:hide">{{ data.event.course.title }}</h1>
        <h2 class="xs:hide">{{ data.event.course.subtitle }}</h2>
        <div class="sm:mt-5x md:mt-10x">
          <router-link :to="{ name: 'expert-profile' }" class="icon-arrow-right:below" :title="__('Zurück')">
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
          <stacked-list-event 
            :event="data.event" 
            :showFee="false">
            <template #action></template>
          </stacked-list-event>
        </template>
      </collapsible>
    </collapsible-container>

    <collapsible-container>
      <collapsible :items="data.participants">
        <template #title>
          {{ __('Teilnehmer') }}
        </template>
        <template #content>
          <stacked-list-item v-for="(participant, index) in data.participants" :key="index">
            {{ participant.firstname }} {{ participant.name }}, {{ participant.city }}
          </stacked-list-item>
          <div class="mt-5x sm:mt-10x">
            <a :href="`/pdf/teilnehmer-liste/${data.event.uuid}`" target="_blank" class="icon-arrow-right:below" :title="__('Download Teilnehmerliste')">
              <span>{{ __('Teilnehmerliste (PDF)') }}</span>
              <icon-arrow-right />
            </a>
          </div>
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
            :eventUuid="data.event.uuid"
            :canCreate="true">
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
            <list-item-file :file="file">
              <template #action>
                <button-file-delete 
                  :file="file"
                  @fileDeleted="fileDeleted($event)"
                  v-if="file.belongs_to_message == false" />
              </template>
            </list-item-file>
          </stacked-list-item>
          <div class="mt-6x">
            <router-link :to="{ name: 'expert-course-event-file' }" class="icon-plus">
              <icon-plus />
            </router-link>
          </div>
        </template>
      </collapsible>
    </collapsible-container>
    
    <notification ref="notification" />
  </div>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import Meta from "@/shared/mixins/Meta";
import i18n from "@/shared/mixins/i18n";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import StackedListEvent from "@/shared/components/ui/layout/StackedListEvent.vue";
import StackedListItem from "@/shared/components/ui/layout/StackedListItem.vue";
import ListItemFile from "@/shared/modules/files/components/ListItem.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";
import IconCheckmark from "@/shared/components/ui/icons/Checkmark.vue";
import IconPlus from "@/shared/components/ui/icons/Plus.vue";
import Messages from "@/shared/modules/messages/Index.vue";
import ButtonFileDelete from "@/shared/modules/files/components/ButtonDelete.vue";

export default {

  components: {
    NProgress,
    ArticleText,
    StackedListEvent,
    StackedListItem,
    ListItemFile,
    CollapsibleContainer,
    Collapsible,
    IconArrowRight,
    IconCheckmark,
    IconPlus,
    Messages,
    ButtonFileDelete
  },

  mixins: [ErrorHandling, i18n, Meta],

  data() {
    return {

      data: [],

      isFetched: false,

      routes: {
        show: '/api/expert/course/event',
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

    fileDeleted(file) {
      const index = this.data.files.findIndex(x => x.uuid === file.uuid);
      if (index > -1) {
        this.data.files.splice(index, 1);
      }

      this.$refs.notification.init({
        message: 'Datei entfernt',
        type: 'toast',
        style: 'success',
      });
    }
  },

  computed: {
    count() {
      return this.data.participants && this.data.participants.length ? this.data.participants.length : 0
    },
  }
}
</script>
  