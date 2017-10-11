require('./bootstrap');
import router from './Routes.js';

var vm = new Vue({
  el: '#app',
  data: {
    message: "SPA"
  },
  router,
  methods: {}
})
