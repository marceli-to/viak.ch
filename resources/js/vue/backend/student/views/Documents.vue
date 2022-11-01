<template>
  <div>

    <article-text v-if="isFetched">
      <template #aside>
        <h1 class="xs:hide">{{ __('Meine Dokumente') }}</h1>
        <back-link :route="'student-profile'"></back-link>
      </template>
    </article-text>

    <collapsible-container>
      <collapsible :expanded="true" :items="documents">
        <template #title>
          {{ __('Dokumente') }}
        </template>
        <template #content>

          <stacked-list-document 
            v-for="document in documents" 
            :key="document.uuid" 
            :document="document">
          </stacked-list-document>

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
import StackedListDocument from "@/shared/components/ui/layout/StackedListDocument.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import BackLink from '@/shared/components/ui/misc/BackLink.vue';

export default {

  components: {
    NProgress,
    ArticleText,
    CollapsibleContainer,
    Collapsible,
    StackedListDocument,
    BackLink
},

  mixins: [ErrorHandling, i18n, Meta],

  data() {
    return {

      documents: null,

      isFetched: true,
      
      routes: {
        get: '/api/student/documents'
      },
    };
  },

  mounted() {
    this.setTitle(this.__('Dokumente'));
    this.find();
  },

  methods: {
    find() {
      NProgress.start();
      this.isFetched = false;
      this.axios.get(`${this.routes.get}`).then(response => {
        this.documents = response.data;
        this.isFetched = true;
        NProgress.done();
      });
    },
  },
}
</script>
  