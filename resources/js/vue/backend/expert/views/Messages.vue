<template>
  <article-text>
    <template #aside>
      <h1 class="xs:hide">{{ __('Nachricht erstellen') }}</h1>
      <p class="text-small sm:mt-3x">{{ __('Sende eine Nachricht an alle Studenten dieses Kurses.') }}</p>
      <back-link :route="`${_getLocale()}-expert-course-event`"></back-link>
    </template>
    <template #content>
      <message-form :redirect="`${_getLocale()}-expert-course-event`"></message-form>
    </template>
  </article-text>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import i18n from "@/shared/mixins/i18n";
import Meta from "@/shared/mixins/Meta";
import Helpers from "@/shared/mixins/Helpers";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import MessageForm from '@/shared/modules/messages/components/Form.vue';
import BackLink from '@/shared/components/ui/misc/BackLink.vue';

export default {

  components: {
    NProgress,
    ArticleText,
    MessageForm,
    BackLink
  },

  mixins: [ErrorHandling, Helpers, i18n, Meta],

  mounted() {
    this.setTitle(this.__('Nachricht erstellen'));
  },  
};
</script>
  