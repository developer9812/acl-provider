require('./bootstrap');
import router from './Routes';
import Http from './services/Http';
import store from './store.js';
import Permission from './services/Permission'

window.EventBus = new Vue();
window.Http = Http;

Vue.directive('can', {
  bind: function (el, binding, vnode) {
    if (!Permission.hasPermission(binding.arg)) {
      	const comment = document.createComment(' ');
      	vnode.elm = comment;
      	vnode.isComment = true;
        return;
    }
  }
});

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
