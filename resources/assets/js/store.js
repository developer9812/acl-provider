import Vuex from 'vuex';

const store = new Vuex.store({
  state : {
    permissions: []
  },
  getters: {
    permissions: state => state.permissions
  },
  mutations: {
    setPermissions: (state, payload) => {
      state.permissions = payload;
    }
  }
})
