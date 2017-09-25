require('./bootstrap');
import PasswordGrantView from './admin/oauth/PasswordGrantView.vue'

var vm = new Vue({
  el: '#app',
  data: {
    activeTab: 'password-grant'
  },
  methods: {
  
  },
  components: {
    'password-grant-view': PasswordGrantView
  }
});
