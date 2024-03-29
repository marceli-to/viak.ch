<template>
  <div v-if="isFetched">
    <article-text class="content-text--event">
      <template #aside>
        <h1 class="xs:hide">{{ data.event.course.title }}</h1>
        <back-link :route="`${_getLocale()}-expert-profile`"></back-link>
      </template>
    </article-text>

    <collapsible-container>
      <collapsible :expanded="true" :uuid="'expert-event-info'">
        <template #title>
          {{ __('Informationen') }}
        </template>
        <template #content>
          <stacked-list-event 
            :event="data.event" 
            :showFee="false"
            :showState="true">
          </stacked-list-event>
        </template>
      </collapsible>
    </collapsible-container>

    <collapsible-container>
      <collapsible :items="data.participants" :uuid="'expert-event-participants'">
        <template #title>
          {{ __('Teilnehmer') }}
        </template>
        <template #content>
          <template v-if="data.participants.length">
            <stacked-list-item v-for="(participant, index) in data.participants" :key="index">
              <div>
                <div class="sm:span-4 md:span-3">{{ participant.fullname }}</div>
                <div class="sm:span-2 md:span-3">{{ participant.city }}</div>
                <div class="sm:span-2 md:span-3">
                  <template v-if="participant.company">
                    {{ participant.company }}
                  </template>
                  <template v-else-if="participant.invoice_address && participant.invoice_address.company">
                    {{ participant.invoice_address.company }}
                  </template>
                </div>
              </div>
            </stacked-list-item>
            <div class="mt-5x sm:mt-10x" v-if="!data.event.is_cancelled">
              <a :href="`/pdf/teilnehmer-liste/${data.event.uuid}`" target="_blank" class="icon-arrow-right:below" :title="__('Download Teilnehmerliste')">
                <span>{{ __('Teilnehmerliste (PDF)') }}</span>
                <icon-arrow-right />
              </a>
            </div>
          </template>
          <template v-else>
            <p class="no-results">
              {{ __('Es sind keine Anmeldungen für diesen Kurs vorhanden.') }}
            </p>
          </template>
        </template>
      </collapsible>
    </collapsible-container>

    <collapsible-container v-if="data.participants.length">
      <collapsible :items="data.messages" :uuid="'expert-event-messages'">
        <template #title>
          {{ __('Nachrichten') }}
        </template>
        <template #content>
          <messages 
            :messages="data.messages" 
            :eventUuid="data.event.uuid"
            :canCreate="true"
            :routeCreate="`${_getLocale()}-expert-course-event-message`">
          </messages>
        </template>
      </collapsible>
    </collapsible-container>

    <collapsible-container>
      <collapsible :items="data.files" :uuid="'expert-event-files'">
        <template #title>
          {{ __('Kurs-Dokumente') }}
        </template>
        <template #content>
          <template v-if="data.files.length">
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
          </template>
          <template v-else>
            <p class="no-results">{{ __('Es sind keine Dokumente vorhanden.') }}</p>
          </template>
          <div class="mt-6x">
            <router-link :to="{ name: `${_getLocale()}-expert-course-event-file` }" class="icon-plus">
              <icon-plus />
            </router-link>
          </div>
        </template>
      </collapsible>
    </collapsible-container>
   
  </div>
</template>
<script>
import NProgress from 'nprogress';
import Validation from "@/shared/mixins/Validation";
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
import BackLink from '@/shared/components/ui/misc/BackLink.vue';

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
    ButtonFileDelete,
    BackLink
  },

  mixins: [Validation, i18n, Meta],

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
      this.$toast.open(this.__('Datei entfernt'));
    }
  },
}
</script>
  