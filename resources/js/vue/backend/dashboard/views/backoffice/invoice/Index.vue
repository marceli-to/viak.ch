<template>
  <div v-if="isLoaded">
  
    <content-list-header>
      <grid class="grid-cols-12">
        <grid-col class="span-8">
          <h1>Rechnungen</h1>
        </grid-col>
        <grid-col class="span-4">
          <search-container @clear="searchQuery = null" :input="searchQuery ? true : false">
            <input type="text" v-model="searchQuery" maxlength="" placeholder="Suchbegriff..." />
          </search-container>
        </grid-col>
      </grid>
    </content-list-header>
  
    <collapsible-container>
      <collapsible :expanded="true" :uuid="'pending-invoices'">
        <template #title>Offene Rechnungen</template>
        <template #content>
          <stacked-list-item class="stacked-list-item--header">
            <div>
              <div class="span-2">Nummer</div>
              <div class="span-2">Datum</div>
              <div class="span-2">Betrag</div>
              <div class="span-6">Student</div>
            </div>
          </stacked-list-item>
          <stacked-list-item v-for="invoice in query('pending')" :key="invoice.id" class="relative">
            <a :href="`/storage/files/${invoice.user.uuid}/${invoice.filename}`" title="Download" target="_blank" class="icon-download mt-3x">
              <icon-download />
            </a>
            <div>
              <div class="span-2">
                <a :href="`/storage/files/${invoice.user.uuid}/${invoice.filename}`" title="Download" target="_blank">
                  {{ invoice.number }}
                </a>
              </div>
              <div class="span-2">
                {{ invoice.date_short }}
              </div>
              <div class="span-2">
                {{ invoice.total | moneyFormat() }}
              </div>
              <div class="span-6" v-if="invoice.user">
                {{ invoice.user.fullname }}, {{ invoice.user.city }}
              </div>

            </div>
          </stacked-list-item>
        </template>
      </collapsible>
    </collapsible-container>
  </div>
  </template>
  <script>
  import NProgress from 'nprogress';
  import SearchContainer from "@/shared/components/ui/form/Search.vue";
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
      SearchContainer,
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
  
        data: {
        },
  
        searchQuery: null,
  
        // Routes
        routes: {
          get: '/api/dashboard/invoices',
        },
  
        // States
        isLoaded: false,
  
      };
    },
  
    created() {
      this.fetch();
    },
  
    methods: {
  
      fetch() {
        NProgress.start();
        this.isLoaded = false;
        this.axios.get(`${this.routes.get}`).then(response => {
          this.data.pending = response.data.pending;
          this.data.paid = response.data.paid;
          this.data.cancelled = response.data.cancelled;
          this.isLoaded = true;
          NProgress.done();
        });
      },
  
      query(type) {
        if (this.searchQuery) {
          return this.data[type].filter((item) => {
            return this.searchQuery.toLowerCase().split(' ').every(
              v => 
              item.number.toLowerCase().includes(v) || 
              item.user.fullname.toLowerCase().includes(v)
            )
          })
        }
        else {
          return this.data[type];
        }
      },
    },
  
  }
  </script>