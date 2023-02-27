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
      <collapsible :expanded="true" :uuid="'open-invoices'">
        <template #title>Offene Rechnungen</template>
        <template #content v-if="query('open').length">
          <stacked-list-item class="stacked-list-item--header">
            <div>
              <div class="span-2">Nummer</div>
              <div class="span-2">Datum</div>
              <div class="span-2">Betrag</div>
              <div class="span-6">Student</div>
            </div>
          </stacked-list-item>
          <stacked-list-item v-for="invoice in query('open')" :key="invoice.id" class="relative">
            <router-link :to="{ name: 'backoffice-invoice-edit', params: { id: invoice.id } }" class="icon-edit mt-3x">
              <icon-edit />
            </router-link>
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
                {{ invoice.grand_total | moneyFormat() }}
              </div>
              <div class="span-6" v-if="invoice.user">
                {{ invoice.user.fullname }}, {{ invoice.user.city }}
              </div>

            </div>
          </stacked-list-item>
        </template>
        <template #content v-else>
          <p class="no-results">Es sind keine offenen Rechnungen vorhanden...</p>
        </template>
      </collapsible>

      <collapsible :uuid="'paid-invoices'" v-if="query('paid').length">
        <template #title>Bezahlte Rechnungen</template>
        <template #content>
          <stacked-list-item class="stacked-list-item--header">
            <div>
              <div class="span-2">Nummer</div>
              <div class="span-2">Datum</div>
              <div class="span-2">Betrag</div>
              <div class="span-6">Student</div>
            </div>
          </stacked-list-item>
          <stacked-list-item v-for="invoice in query('paid')" :key="invoice.id" class="relative">
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
                {{ invoice.grand_total | moneyFormat() }}
              </div>
              <div class="span-6" v-if="invoice.user">
                {{ invoice.user.fullname }}, {{ invoice.user.city }}
              </div>

            </div>
          </stacked-list-item>
        </template>
      </collapsible>

      <collapsible :uuid="'overdue-invoices'" v-if="query('overdue').length">
        <template #title>Fällige Rechnungen</template>
        <template #content>
          <stacked-list-item class="stacked-list-item--header">
            <div>
              <div class="span-2">Nummer</div>
              <div class="span-2">Datum</div>
              <div class="span-2">Betrag</div>
              <div class="span-6">Student</div>
            </div>
          </stacked-list-item>
          <stacked-list-item v-for="invoice in query('overdue')" :key="invoice.id" class="relative">
            <router-link :to="{ name: 'backoffice-invoice-edit', params: { id: invoice.id } }" class="icon-edit mt-3x">
              <icon-edit />
            </router-link>
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
                {{ invoice.grand_total | moneyFormat() }}
              </div>
              <div class="span-6" v-if="invoice.user">
                {{ invoice.user.fullname }}, {{ invoice.user.city }}
              </div>

            </div>
          </stacked-list-item>
        </template>
      </collapsible>

      <collapsible :uuid="'cancelled-invoices'" v-if="query('cancelled').length">
        <template #title>Stornierte Rechnungen</template>
        <template #content>
          <stacked-list-item class="stacked-list-item--header">
            <div>
              <div class="span-2">Nummer</div>
              <div class="span-2">Datum</div>
              <div class="span-2">Betrag</div>
              <div class="span-6">Student</div>
            </div>
          </stacked-list-item>
          <stacked-list-item v-for="invoice in query('cancelled')" :key="invoice.id" class="relative">
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
                {{ invoice.grand_total | moneyFormat() }}
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
          open: null,
          paid: null,
          cancelled: null,
          overdue: null
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
          this.data.open = response.data.open;
          this.data.paid = response.data.paid;
          this.data.cancelled = response.data.cancelled;
          this.data.overdue = response.data.overdue;
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