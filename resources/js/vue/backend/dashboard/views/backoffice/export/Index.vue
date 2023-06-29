<template>
  <div v-if="isLoaded">
  
    <content-list-header>
      <grid class="grid-cols-12">
        <grid-col class="span-8">
          <h1>Exporte</h1>
        </grid-col>
      </grid>
    </content-list-header>
  
    <grid class="grid-cols-12 mt-6x">
      <grid-col class="span-4">
        <a :href="'/export/kurs-liste?v='+ timestamp" class="btn-primary" target="_blank">Download Kurse + Teilnehmer (Excel)</a>
      </grid-col>
    </grid>

  </div>
  </template>
  <script>
  import NProgress from 'nprogress';
  import Grid from "@/shared/components/ui/layout/Grid.vue";
  import GridCol from "@/shared/components/ui/layout/GridCol.vue";
  import ContentListHeader from "@/shared/components/ui/layout/ContentListHeader.vue";
  import StackedListContainer from "@/shared/components/ui/layout/StackedListContainer.vue";
  import StackedListItem from "@/shared/components/ui/layout/StackedListItem.vue";
  import StackedListHeader from "@/shared/components/ui/layout/StackedListHeader.vue";
  import StackedListFooter from "@/shared/components/ui/layout/StackedListFooter.vue";
  import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
  import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
  import IconEdit from "@/shared/components/ui/icons/Edit.vue";
  import IconPlus from "@/shared/components/ui/icons/Plus.vue";
  import IconDownload from "@/shared/components/ui/icons/Download.vue";

  export default {
  
    components: {
      NProgress,
      Grid,
      GridCol,
      ContentListHeader,
      StackedListContainer,
      StackedListItem,
      StackedListHeader,
      StackedListFooter,
      CollapsibleContainer,
      Collapsible,
      IconEdit,
      IconPlus,
      IconDownload
    },
  
    mixins: [],
  
    data() {
      return {


  
        // States
        isLoaded: true,
  
      };
    },
  
    created() {
    },
  
    methods: {
  
    },

    computed: {
      timestamp() {
        return Date.now();
      }
    }
  
  }
  </script>