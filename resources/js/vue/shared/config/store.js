import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user: false,
    i18n: false,
    collapsibles: [],
    isLoading: false,
  },

  mutations: {
    user(state, payload) {
      state.user = payload;
    },
    
    i18n(state, payload) {
      state.i18n = payload;
    },

    collapsibles(state, payload) {
      state.collapsibles = payload;
    },

    isLoading(state, payload) {
      state.isLoading = payload;
    }
  },

});