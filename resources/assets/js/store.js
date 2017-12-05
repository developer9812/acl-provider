import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

const store = new Vuex.Store({
  state : {
    intendedPath: '/',
    // username: '',
    permissions: []
  },
  getters: {
    intendedPath: state => state.intendedPath,
    permissions: state => state.permissions,
    // username: state => state.username
  },
  mutations: {
    setIntendedPath: (state, payload) => {
      state.intendedPath = payload;
    },
    setPermissions: (state, payload) => {
      state.permissions = payload;
    }
    // setUsername: (state, payload) => {
    //   state.username = payload;
    // }
  }
})

export default store;
