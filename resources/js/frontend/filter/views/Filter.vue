<template>
<div class="grid-cols-12">
  <div class="span-8">
    <template v-if="!hasResults">
      <slot />
    </template>
    <template v-else>
      <div class="grid-cols-12">
        <article v-for="d in data" :key="d.uuid" class="card-teaser span-6">
          <a href="">
            <div>
              <div>{{ d.categories }}</div>
              <h1>{{ d.title }}</h1>
            </div>
            <figure>
              <div>
                <div v-if="d.upcoming">
                  Übersicht:<br>
                  <ul>
                    <li>Experte: {{ d.experts}}</li>
                    <li>ab {{ d.date }}</li>
                    <li v-if="d.online">Online Schulung</li>
                    <li>CHF {{ d.fee }}</li>
                  </ul>
                </div>
                <p>Weitere Informationen</p>
              </div>
              <img src="/media/dummy-1.png" class="is-responsive">
            </figure>
          </a>
        </article>
      </div>
    </template>
  </div>
  <div class="span-4">
    <h2 class="mb-8x">Filter</h2>
    <form @submit.prevent="filter()">
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
          @change="getData()">
          <option value="null">Ort</option>
          <option value="online">online</option>
          <option value="offline">vor Ort</option>
        </select>
      </div>
      <div class="select-wrapper">
        <select 
          v-model="filter.level"
          @change="getData()">
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
          @change="getData()">
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
          @change="getData()">
          <option value="null">Experte</option>
          <option 
            v-for="(option, id) in options.experts" 
            :key="id" 
            :value="id">
            {{option}}
          </option>
        </select>
      </div>
      <div class="mt-10x">
        <a href="" @click.prevent="showResults()" class="">
          Anzeigen {{ data.length ? `(${data.length})` : '' }}
        </a>
        <br><br>
        <a href="" @click.prevent="resetFilterItems()">Filter zurücksetzen</a>
      </div>
    </form>
  </div> 
</div>
</template>
<script>
import ErrorHandling from "@frontend/filter/mixins/ErrorHandling";
import NProgress from 'nprogress';

export default {

  components: {
    NProgress,
  },

  mixins: [ErrorHandling],

  data() {
    return {

      // Data
      data: [],

      // Options 
      options: [],

      // Filter
      filter: {
        location: null,
        category: null,
        language: null,
        level: null,
        expert: null
      },

      // States
      isLoading: false,
      hasResults: false,

      // Routes
      routes: {
        filter: '/api/course/filter',
        settings: '/api/course/filters',
      },
    };
  },

  mounted() {
    NProgress.configure({ showBar: false });
    this.getSettings();
  },

  methods: {

    getData() {
      NProgress.start();
      this.isFetched = false;
      console.log(this.filter);
      this.axios.post(`${this.routes.filter}`, this.filter).then(response => {
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
      this.getData();
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

    showResults() {},

  },
}
</script>
