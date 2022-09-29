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
      <collapsible>
        <template #title>
          {{ __('Teilnehmer') }}
        </template>
        <template #content>

        </template>
      </collapsible>
    </collapsible-container>

    <collapsible-container>
      <collapsible>
        <template #title>
          {{ __('Unterlagen') }}
        </template>
        <template #content>

        </template>
      </collapsible>
    </collapsible-container>

    <collapsible-container>
      <collapsible>
        <template #title>
          {{ __('Nachrichten') }}
        </template>
        <template #content>

        </template>
      </collapsible>
    </collapsible-container>
  </div>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import Meta from "@/shared/mixins/Meta";
import i18n from "@/shared/mixins/i18n";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import StackedListEvent from "@/shared/components/ui/layout/StackedListEvent.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";
import IconCheckmark from "@/shared/components/ui/icons/Checkmark.vue";

export default {

  components: {
    NProgress,
    ArticleText,
    StackedListEvent,
    CollapsibleContainer,
    Collapsible,
    IconArrowRight,
    IconCheckmark,
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

  },
}
</script>
  