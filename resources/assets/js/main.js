require('./bootstrap');
import PasswordGrantView from './admin/oauth/PasswordGrantView.vue'

var vm = new Vue({
  el: '#app',
  data: {
    activeTab: 'password-grant',
    tokenExpiry: 1,
    expiryUnit: 'minute'
  },
  methods: {
    updateExpiry: function(){
      axios.post('/admin/oauth/expiry/update', {
        token_expiry: this.tokenExpiry
      }).then(response => {
        console.log('RESPONSE');
        console.log(response);
      }).catch(error => {
        console.log("ERROR");
        console.log(error);
      })
    },
    getTokenExpiry: function(){
      axios.get('/admin/oauth/expiry')
        .then(response => {
          console.log(response);
          this.tokenExpiry = response.data.value;
        })
        .catch(error => {

        })
    }
  },
  watch: {
    'activeTab': function(value){
      if (value == 'settings') {
        this.getTokenExpiry();
      }
    }
  },
  components: {
    'password-grant-view': PasswordGrantView
  }
});
