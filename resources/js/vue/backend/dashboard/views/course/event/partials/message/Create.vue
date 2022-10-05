<template>
  <article-text>
    <template #aside>
      <h1>{{ __('Nachricht erstellen') }}</h1>
      <p class="text-small sm:mt-3x">{{ __('Sende eine Nachricht an alle Studenten dieses Kurses.') }}</p>
      <div class="sm:mt-5x md:mt-10x">
        <router-link :to="{ name: 'event-show' }" class="icon-arrow-right:below">
          <span>{{ __('Zurück') }}</span>
          <icon-arrow-right :size="'sm'" />
        </router-link>
      </div>
    </template>
    <template #content>
      <message-form 
        :redirect="'event-show'">
      </message-form>
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
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";
import MessageForm from '@/shared/modules/messages/components/Form.vue';

export default {

  components: {
    NProgress,
    ArticleText,
    IconArrowRight,
    MessageForm
  },

  mixins: [ErrorHandling, Helpers, i18n, Meta],

  data() {
    return {

    };
  },

  mounted() {
    this.setTitle(this.__('Nachricht erstellen'));
  },  
};
</script>
  