<template>
<grid class="grid-cols-12">
  <grid-col class="span-12 sm:span-8">
    <a href="javascript:;" class="icon-filter sm:hide" @click.prevent="toggleFilter()">
      <icon-filter :active="hasFilter ? true : false" />
    </a>
    <template v-if="!hasResults">
      <slot />
    </template>
    <template v-else>
      <grid class="grid-cols-12">
        <card v-for="d in data" :key="d.uuid" class="card-teaser span-6" :data="d" />
      </grid>
    </template>
  </grid-col>
  <grid-col class="sm:span-4 !sm:block" v-show="hasFilter">
    <div class="filter">
      <h2>Filter</h2>
      <form @submit.prevent="filter()">
        <div :class="[filter.category == id ? 'is-active' : '', 'filter__item']"
          v-for="(category, id) in options.categories" :key="id">
          <a href="" @click.prevent="updateFilterItem('category', id)">
            {{ category }}
          </a>
        </div>
        <div :class="[filter.location ? 'is-active' : '', 'filter__item mt-10x']">
          <div class="select-wrapper">
            <select 
              v-model="filter.location"
              @change="doFilter()">
              <option value="null">Ort</option>
              <option value="online">online</option>
              <option value="offline">vor Ort</option>
            </select>
          </div>
        </div>
        <div :class="[filter.level ? 'is-active' : '', 'filter__item']">
          <div class="select-wrapper">
            <select 
              v-model="filter.level"
              @change="doFilter()">
              <option value="null">Level</option>
              <option 
                v-for="(option, id) in options.levels" 
                :key="id" 
                :value="id">
                {{option}}
              </option>
            </select>
          </div>
        </div>
        <div :class="[filter.language ? 'is-active' : '', 'filter__item']">
          <div class="select-wrapper">
            <select 
              v-model="filter.language"
              @change="doFilter()">
              <option value="null">Sprache</option>
              <option 
                v-for="(option, id) in options.languages" 
                :key="id" 
                :value="id">
                {{option}}
              </option>
            </select>
          </div>
        </div>
        <div :class="[filter.expert ? 'is-active' : '', 'filter__item']">
          <div class="select-wrapper">
            <select 
              v-model="filter.expert"
              @change="doFilter()">
              <option value="null">Experte</option>
              <option 
                v-for="(option, id) in options.experts" 
                :key="id" 
                :value="id">
                {{option}}
              </option>
            </select>
          </div>
        </div>
        <div class="filter__buttons mt-10x">
          <a href="" @click.prevent="showResults()" class="btn-primary sm:hide">
            {{ __('Anzeigen') }} {{ data.length ? `(${data.length})` : '' }}
          </a>
          <a href="" @click.prevent="resetFilterItems()" class="link-helper">
            {{ __('Zurücksetzen') }}
          </a>
        </div>

        <!--
        <template v-if="hasSearch">
          <h2 class="mb-8x mt-8x">Suche</h2>
          <input type="text" name="keyword" v-model="filter.keyword" @blur="doSearch()">
        </template>
        -->
      </form>
    </div> 
  </grid-col>
</grid>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/modules/filter/mixins/ErrorHandling";
import i18n from "@/shared/mixins/i18n";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
import IconFilter from "@/shared/components/ui/icons/Filter.vue";
import Card from "@/modules/filter/components/Card.vue";

export default {

  components: {
    NProgress,
    IconFilter,
    Grid,
    GridCol,
    Card,
  },

  mixins: [ErrorHandling, i18n],

  data() {
    return {

      // Data
      data: [],

      // Options 
      options: [],

      // Filter
      filter: {
        keyword: null,
        location: null,
        category: null,
        language: null,
        level: null,
        expert: null
      },

      // States
      isLoading: false,
      hasResults: false,
      hasSearch: false,
      hasFilter: false,

      // Routes
      routes: {
        filter: '/api/course/filter',
        search: '/api/course/search',
        settings: '/api/course/filters',
      },
    };
  },

  mounted() {
    NProgress.configure({ showBar: false });
    this.getSettings();
  },

  methods: {

    doFilter() {
      NProgress.start();
      this.isFetched = false;
      this.axios.post(`${this.routes.filter}`, this.filter).then(response => {
        this.data = response.data;
        this.isFetched = true;
        this.hasResults = true;
        NProgress.done();
      });
    },

    doSearch() {
      NProgress.start();
      this.isFetched = false;
      this.axios.post(`${this.routes.search}`, {keyword: this.filter.keyword}).then(response => {
        this.data = response.data;
        this.isFetched = true;
        this.hasResults = true;
        NProgress.done();
      });
    },

    getSettings() {
      this.isFetched = false;
      NProgress.start();
      this.axios.get(`${this.routes.settings}`).then(response => {
        this.options = response.data;
        this.isFetched = true;
        NProgress.done();
      });
    },

    updateFilterItem(type, value) {
      if (this.filter[type] == value) {
        this.filter[type] = null;
      }
      else {
        this.filter[type] = value;
      }
      this.$store.commit('filter', this.filter);
      this.doFilter();
    },

    resetFilterItems() {
      this.filter.location = null;
      this.filter.category = null;
      this.filter.language = null;
      this.filter.level = null;
      this.filter.expert = null;
      this.data = [];
      this.$store.commit('filter', this.filter);
      this.hasResults = false;
      this.showResults();
    },

    toggleFilter() {
      this.hasFilter = this.hasFilter ? false : true;
    },

    showResults() {
      this.hasFilter = false;
    },

  },
}
</script>
