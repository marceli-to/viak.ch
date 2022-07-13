<template>
<div class="grid-cols-12">
  <div class="span-12 sm:span-8">
    <a href="javascript:;" class="icon-filter sm:hide" @click.prevent="toggleFilter()">
      <icon-filter :active="hasFilter ? true : false" />
    </a>
    <template v-if="!hasResults">
      <slot />
    </template>
    <template v-else>
      <div class="grid-cols-12">

        <card v-for="d in data" :key="d.uuid" class="card-teaser span-6" :data="d" />

        <!-- <article v-for="d in data" :key="d.uuid" class="card-teaser span-6">
          <a href="">
            <header>
              <div class="card__category">
                {{ d.categories }}
              </div>
              <h2 class="card__heading">
                {{ d.title }}
              </h2>
            </header>
            <figure>
              <div>
                <div v-if="d.upcoming">
                  {{ i18n('Übersicht') }}:<br>
                  <ul>
                    <li>Experte: {{ d.experts}}</li>
                    <li>ab {{ d.date }}</li>
                    <li v-if="d.online">Online Schulung</li>
                    <li>CHF {{ d.fee }}</li>
                  </ul>
                </div>
                <p class="mt-4x sm:mt-6x">Weitere Informationen</p>
              </div>
              <img src="/media/dummy-1.png" class="is-responsive">
            </figure>
          </a>
        </article> -->
      </div>
    </template>
  </div>
  <div class="filter sm:span-4" v-show="hasFilter">
    <h2 class="mb-8x">Filter</h2>
    <form @submit.prevent="filter()" class="">
      <div class="mb-8x">
        <a 
          v-for="(option, id) in options.categories" :key="id"
          href="" 
          @click.prevent="updateFilterItem('category', id)" 
          class="btn-filter">
          <span v-if="filter.category == id" class="mr-1x">&bull;</span>
          {{ option }}
        </a>
      </div>
      <div class="select-wrapper">
        <select 
          v-model="filter.location"
          @change="doFilter()">
          <option value="null">Ort</option>
          <option value="online">online</option>
          <option value="offline">vor Ort</option>
        </select>
      </div>
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
      <div class="mt-10x flex justify-between">
        <a href="" @click.prevent="showResults()" class="">
          Anzeigen {{ data.length ? `(${data.length})` : '' }}
        </a>
        <br><br>
        <a href="" @click.prevent="resetFilterItems()">Filter zurücksetzen</a>
      </div>
      <template v-if="hasSearch">
        <h2 class="mb-8x mt-8x">Suche</h2>
        <input type="text" name="keyword" v-model="filter.keyword" @blur="doSearch()">
      </template>
    </form>
  </div> 
</div>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/modules/filter/mixins/ErrorHandling";
import i18n from "@/shared/mixins/i18n";
import IconFilter from "@/shared/components/ui/icons/Filter.vue";
import Card from "@/modules/filter/components/Card.vue";

export default {

  components: {
    NProgress,
    IconFilter,
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
    },

    toggleFilter() {
      this.hasFilter = this.hasFilter ? false : true;
    },

    showResults() {},

  },
}
</script>
