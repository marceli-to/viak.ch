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
          v-for="(category, id) in settings.categories" :key="id"
          href="" 
          @click.prevent="setFilterItem('category', id)" 
          class="btn-filter">
          <span v-if="isFilterAttribute('category', id)" class="mr-1x">&bull;</span>
          {{ category }}
        </a>
      </div>
      <div class="select-wrapper">
        <select @change.prevent="setFilterItem('expert', $event.target.value)">
          <option value="NULL">Experte</option>
          <option 
            v-for="(expert, id) in settings.experts" 
            :key="id" 
            :value="id">
            {{expert}}
          </option>
        </select>
      </div>
      <div class="mt-10x">
        <a href="" @click.prevent="resetFilterItems()">Zurücksetzen</a>
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

      settings: [],

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
      const store = this.$store.state.filter;
      let param = {
        category: store.category ? store.category : null,
        expert: store.expert ? store.expert : null,
      };
      NProgress.start();
      this.isFetched = false;
      this.axios.post(`${this.routes.filter}`, param).then(response => {
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
        this.settings = response.data;
        this.isFetched = true;
        NProgress.done();
      });
    },

    setFilterItem(type, value) {
      let filter = this.$store.state.filter;

      // Multi types
      if (Array.isArray(filter[type])) {
        if (this.isFilterAttribute(type,value)) {
          const index = filter[type].findIndex(x => x === value);
          if (index > -1) {
            filter[type].splice(index, 1);
          }
        }
        else {
          filter[type].push(value);
        }
      }
      // Single types
      else {
        if (filter[type] == value) {
          filter[type] = null;
        }
        else {
          filter[type] = value;
        }
      }
      
      filter['set'] = true;
      this.$store.commit('filter', filter);
      this.getData();
    },

    resetFilterItems() {
      let filter = {
        set: false,
        category: '',
        expert: '',
      };
      this.$store.commit('filter', filter);
      this.hasResults = false;
    },
    
    isFilterAttribute(type, value) {
      let filter = this.$store.state.filter;
      if (filter[type] == value) {
        return true;
      }
      return false;
    }
  },
}
</script>
