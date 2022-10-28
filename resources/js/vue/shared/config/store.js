import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user: false,
    i18n: false,
    collapsibles: [],
  },
  mutations: {
    user(state, user) {
      state.user = user;
    },
    i18n(state, i18n) {
      state.i18n = i18n;
    },
    collapsibles(state, collapsibles) {
      state.collapsibles = collapsibles;
    },
  }
});