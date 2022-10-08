import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user: false,
    i18n: false,
    discount_code: false,
    filter: {
      category: null,
      expert: null,
      language: null,
      level: null,
    },
  },
  mutations: {
    user(state, user) {
      state.user = user;
    },
    filter(state, filter) {
      state.filter = filter;
    },
    i18n(state, i18n) {
      state.i18n = i18n;
    },
    discount_code(state, discount_code) {
      state.discount_code = discount_code;
    }
  }
});