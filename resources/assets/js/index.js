require('./bootstrap');
import router from './Routes';
import Http from './services/Http';
import store from './store.js';
import Permission from './services/Permission'

window.EventBus = new Vue();
window.Http = Http;

var vm = new Vue({
  el: '#app',
  data: {
    message: "SPA"
  },
  store,
  created: function(){
    EventBus.$on('auth-error', () => {
      location.reload();
      this.$router.push('/login');
    })
  },
  router,
  methods: {}
})
