<template>
<grid class="grid-cols-12">
  <grid-col class="span-12 sm:span-8">
    <a href="javascript:;" class="icon-filter sm:hide" @click.prevent="toggleFilter()">
      <icon-filter :active="hasFilter ? true : false" />
    </a>
    <template v-if="!hasResults">
      <slot />
    </template>
    <template v-else-if="courses.length">
      <grid class="grid-cols-12">
        <card v-for="d in courses" :key="d.uuid" class="card-teaser span-6" :data="d" />
      </grid>
    </template>
    <template v-else>
      <grid class="grid-cols-12">
        <div class="span-12">{{ __('Leider keine Kurse gefunden.') }}</div>
      </grid>
    </template>
  </grid-col>
  <grid-col class="sm:span-4 !sm:block" v-show="hasFilter">
    <div class="filter">
      <h2>Filter</h2>
      <form @submit.prevent="filter()">
      <div class="filter__items">
        <div :class="[filterItems.category == id || options.filter.items.category == id ? 'is-active' : '', 'filter__item']"
          v-for="(category, id) in options.settings.categories" :key="id">
          <a href="" @click.prevent="updateFilter('category', id)">
            {{ category }}
          </a>
        </div>
        <div :class="[filterItems.location != 'null' ? 'is-active' : '', 'filter__item mt-10x']">
          <div class="select-wrapper">
            <select 
              v-model="filterItems.location"
              @change="filter()">
              <option value="null">Ort</option>
              <option value="online">online</option>
              <option value="offline">vor Ort</option>
            </select>
          </div>
        </div>
        <div :class="[filterItems.software != 'null' ? 'is-active' : '', 'filter__item']">
          <div class="select-wrapper">
            <select 
              v-model="filterItems.software"
              @change="filter()">
              <option value="null">Software</option>
              <option 
                v-for="(option, id) in options.settings.software" 
                :key="id" 
                :value="id">
                {{option}}
              </option>
            </select>
          </div>
        </div>
        <div :class="[filterItems.level != 'null' ? 'is-active' : '', 'filter__item']">
          <div class="select-wrapper">
            <select 
              v-model="filterItems.level"
              @change="filter()">
              <option value="null">Level</option>
              <option 
                v-for="(option, id) in options.settings.levels" 
                :key="id" 
                :value="id">
                {{option}}
              </option>
            </select>
          </div>
        </div>
        <div :class="[filterItems.language != 'null' ? 'is-active' : '', 'filter__item']">
          <div class="select-wrapper">
            <select 
              v-model="filterItems.language"
              @change="filter()">
              <option value="null">Sprache</option>
              <option 
                v-for="(option, id) in options.settings.languages" 
                :key="id" 
                :value="id">
                {{option}}
              </option>
            </select>
          </div>
        </div>
        <div :class="[filterItems.expert != 'null' ? 'is-active' : '', 'filter__item']">
          <div class="select-wrapper">
            <select 
              v-model="filterItems.expert"
              @change="filter()">
              <option value="null">Experte</option>
              <option 
                v-for="(option, id) in options.settings.experts" 
                :key="id" 
                :value="id">
                {{option}}
              </option>
            </select>
          </div>
        </div>
        <div class="filter__buttons mt-10x sm:mt-4x">
          <a href="" @click.prevent="showResults()" class="btn-primary sm:hide">
            {{ __('Anzeigen') }} {{ courses.length ? `(${courses.length})` : '' }}
          </a>
          <a href="" @click.prevent="resetFilter()" class="btn-primary is-outline mt-4x" data-touch>
            {{ __('Zurücksetzen') }}
          </a>
        </div>
      </div>
        <!--
        <template v-if="hasSearch">
          <h2 class="mb-8x mt-8x">Suche</h2>
          <input type="text" name="keyword" v-model="filterItems.keyword" @blur="search()">
        </template>
        -->
      </form>
    </div> 
  </grid-col>
</grid>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
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

      // Courses
      courses: [],

      // Options 
      options: {
        settings: [],
        filter: {
          items: {
            category: null,
          }
        },
      },

      // Filter
      filterItems: {
        keyword: null,
        category: null,
        software: null,
        location: 'null',
        language: 'null',
        level: 'null',
        expert: 'null'
      },

      store: {},

      // States
      isLoading: false,
      hasResults: false,
      hasSearch: false,
      hasFilter: false,

      // Routes
      routes: {
        filter: '/api/course/filter',
        reset: '/api/course/filter',
        search: '/api/course/search',
        settings: '/api/course/filters',
      },
    };
  },

  mounted() {
    this.settings();
  },

  methods: {

    filter() {
      NProgress.start();
      this.isFetched = false;
      this.axios.post(`${this.routes.filter}`, this.filterItems).then(response => {
        this.courses = response.data.courses;
        this.options.filter = response.data.filter;
        this.isFetched = true;
        this.hasResults = true;
        this.markupFilters();
        NProgress.done();
      });
    },

    // search() {
    //   NProgress.start();
    //   this.isFetched = false;
    //   this.axios.post(`${this.routes.search}`, {keyword: this.filterItems.keyword}).then(response => {
    //     this.courses = response.data.courses;
    //     this.isFetched = true;
    //     this.hasResults = true;
    //     NProgress.done();
    //   });
    // },

    settings() {
      this.isFetched = false;
      NProgress.start();
      this.axios.get(`${this.routes.settings}`).then(response => {
        this.options.settings = response.data.settings;
        if (response.data.filter != null) {
          this.options.filter = response.data.filter;
        }
        this.isFetched = true;
        this.markupFilters();
        NProgress.done();
      });
    },

    updateFilter(type, value) {
      if (this.filterItems[type] == value) {
        this.filterItems[type] = 'null';
      }
      else {
        this.filterItems[type] = value;
      }
      this.$store.commit('filter', this.filterItems);
      this.filter();
    },

    resetFilter() {
      NProgress.start();
      this.axios.delete(`${this.routes.reset}`).then(response => {
        this.filterItems.category = null;
        this.filterItems.location = 'null';
        this.filterItems.language = 'null';
        this.filterItems.level = 'null';
        this.filterItems.expert = 'null';
        this.filterItems.software = 'null';
        this.courses = [];
        this.$store.commit('filter', this.filterItems);
        this.filter();
      });
    },

    toggleFilter() {
      this.hasFilter = this.hasFilter ? false : true;
    },

    markupFilters() {
      this.filterItems.software = this.options.filter.items.software != null ? this.options.filter.items.software : 'null';
      this.filterItems.expert = this.options.filter.items.expert != null ? this.options.filter.items.expert : 'null';
      this.filterItems.location = this.options.filter.items.location != null ? this.options.filter.items.location : 'null';
      this.filterItems.language = this.options.filter.items.language != null ? this.options.filter.items.language : 'null';
      this.filterItems.level = this.options.filter.items.level != null ? this.options.filter.items.level : 'null';
    },

    showResults() {
      this.hasFilter = false;
    },

  },
}
</script>
