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

          <div 
            :class="[filterAttributes.category == id ? 'is-active' : '', 'filter__item']"
            v-for="(category, id) in options.settings.categories" 
            :key="id">
            <a href="" @click.prevent="setCategory('category', id, category)">
              {{ category }}
            </a>
          </div>
          
          <div 
            :class="[filterAttributes.location != 'null' ? 'is-active' : '', 'filter__item mt-10x']">
            <div class="select-wrapper">
              <select 
                v-model="filterAttributes.location"
                @change="updateUrlParams()">
                <option value="null">Ort</option>
                <option value="online">online</option>
                <option value="offline">vor Ort</option>
              </select>
            </div>
          </div>
          
          <div 
            :class="[filterAttributes.software != 'null' ? 'is-active' : '', 'filter__item']">
            <div class="select-wrapper">
              <select 
                v-model="filterAttributes.software"
                @change="updateUrlParams()">
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

          <div 
            :class="[filterAttributes.level != 'null' ? 'is-active' : '', 'filter__item']">
            <div class="select-wrapper">
              <select 
                v-model="filterAttributes.level"
                @change="updateUrlParams()">
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

          <div 
            :class="[filterAttributes.language != 'null' ? 'is-active' : '', 'filter__item']">
            <div class="select-wrapper">
              <select 
                v-model="filterAttributes.language"
                @change="updateUrlParams()">
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

          <div 
            :class="[filterAttributes.expert != 'null' ? 'is-active' : '', 'filter__item']">
            <div class="select-wrapper">
              <select 
                v-model="filterAttributes.expert"
                @change="updateUrlParams()">
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

          <div 
            :class="[filterAttributes.tag != 'null' ? 'is-active' : '', 'filter__item']">
            <div class="select-wrapper">
              <select 
                v-model="filterAttributes.tag"
                @change="updateUrlParams()">
                <option value="null">Tags</option>
                <option 
                  v-for="(option, uuid) in options.settings.tags" 
                  :key="uuid" 
                  :value="uuid">
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
      </form>
    </div> 
  </grid-col>
</grid>
</template>
<script>
import NProgress from 'nprogress';
import i18n from "@/shared/mixins/i18n";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
import IconFilter from "@/shared/components/ui/icons/Filter.vue";
import Card from "@/frontend/filter/components/Card.vue";

export default {

  components: {
    NProgress,
    IconFilter,
    Grid,
    GridCol,
    Card,
  },

  mixins: [i18n],

  data() {
    return {

      // Courses
      courses: [],

      // Options 
      options: {
        settings: [],
        filter: {
          attributes: {
            category: null,
          }
        },
      },

      // Filter
      filterAttributes: {
        //keyword: null,
        category: null,
        software: 'null',
        location: 'null',
        language: 'null',
        level: 'null',
        expert: 'null',
        tag: 'null',
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
    this.getSettings();
    this.addEventListeners();
  },

  methods: {

    addEventListeners() {

      // History changes
      window.addEventListener('popstate', (event) => {
        const url = new URL(window.location);
        url.searchParams.forEach((value, key) => {
          this.filterAttributes[key] = value;
          this.getResults();
        })
      });

      // Page load
      window.addEventListener('load', (event) => {
        const url = new URL(window.location);
        url.searchParams.forEach((value, key) => {
          this.filterAttributes[key] = value;
        })
      });

    },
    
    getResults() {
      NProgress.start();
      this.isFetched = false;
      this.axios.post(`${this.routes.filter}`, this.filterAttributes).then(response => {
        this.courses = response.data.courses;
        this.isFetched = true;
        this.hasResults = true;
        NProgress.done();
      });
    },

    getSettings() {
      this.isFetched = false;
      NProgress.start();
      this.axios.get(`${this.routes.settings}`).then(response => {
        this.options.settings = response.data.settings;
        this.isFetched = true;
        NProgress.done();
      });
    },

    setCategory(type, value) {
      if (this.filterAttributes[type] == value) {
        this.filterAttributes[type] = 'null';
      }
      else {
        this.filterAttributes[type] = value;
      }
      this.updateUrlParams();
    },

    updateUrlParams() {
      const url = new URL(window.location);
      Object.keys(this.filterAttributes).forEach(key => {
        if (this.filterAttributes[key] != 'null' && this.filterAttributes[key] != null) {
          url.searchParams.set(key, this.filterAttributes[key]);
        }
        else {
          url.searchParams.delete(key);
        }
      });
      window.history.pushState({}, '', url);
      this.getResults();
    },

    resetFilter() {
      NProgress.start();
      this.axios.delete(`${this.routes.reset}`).then(response => {
        this.filterAttributes.category = null;
        this.filterAttributes.location = 'null';
        this.filterAttributes.language = 'null';
        this.filterAttributes.level = 'null';
        this.filterAttributes.expert = 'null';
        this.filterAttributes.software = 'null';
        this.filterAttributes.tag = 'null';
        this.courses = [];
        this.updateUrlParams();
      });
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
