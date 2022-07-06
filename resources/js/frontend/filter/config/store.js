import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    filter: {
      set: false,
      category: '',
      expert: '',
    },
  },
  mutations: {
    filter(state, filter) {
      state.filter = filter;
    },
  }
});