<template>
  <div>
    <article-text v-if="isFetched">
      <template #aside>
        <h1 class="xs:hide">Dokumente</h1>
        <div class="sm:mt-5x md:mt-10x">
          <router-link :to="{name: `student-show`, params: { id: $route.params.id }}" class="icon-arrow-left:below" :title="__('Zurück')">
            <span>{{ __('Zurück') }}</span>
            <icon-arrow-left />
          </router-link>
        </div>
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
import i18n from "@/shared/mixins/i18n";
import IconArrowLeft from "@/shared/components/ui/icons/ArrowLeft.vue";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import StackedListDocument from "@/shared/components/ui/layout/StackedListDocument.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import BackLink from '@/shared/components/ui/misc/BackLink.vue';

export default {

  components: {
    NProgress,
    IconArrowLeft,
    ArticleText,
    CollapsibleContainer,
    Collapsible,
    StackedListDocument,
    BackLink
},

  mixins: [i18n],

  data() {
    return {

      documents: null,

      isFetched: true,
      
      routes: {
        get: '/api/dashboard/student/documents'
      },
    };
  },

  mounted() {
    this.find();
  },

  methods: {
    find() {
      NProgress.start();
      this.isFetched = false;
      this.axios.get(`${this.routes.get}/${this.$route.params.id}`).then(response => {
        this.documents = response.data;
        this.isFetched = true;
        NProgress.done();
      });
    },
  },
}
</script>
  