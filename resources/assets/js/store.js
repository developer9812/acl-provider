import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

const store = new Vuex.Store({
  state : {
    intendedPath: '/',
    permissions: []
  },
  getters: {
    intendedPath: state => state.intendedPath,
    permissions: state => state.permissions
  },
  mutations: {
    setIntendedPath: (state, payload) => {
      state.intendedPath = payload;
    },
    setPermissions: (state, payload) => {
      state.permissions = payload;
    }
  }
})

export default store;
