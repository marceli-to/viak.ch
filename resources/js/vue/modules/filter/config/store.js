import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    filter: {
      category: null,
      expert: null,
      language: null,
      level: null,
    },
  },
  mutations: {
    filter(state, filter) {
      state.filter = filter;
    },
  }
});