require ('../bootstrap.js');
import UserView from './UserView.vue';

var vm = new Vue({
  el: '#app',
  data: {
    users: [],
    userSearch: "",
    filteredUsers: [],
    selectedUser: null
  },
  created: function() {
    this.getUsers();
  },
  methods: {
    getUsers: function(){
      axios.get('/users')
        .then(response => {
          response.data.forEach((user, index) => {
            console.log("Users fetched successfully");
            Vue.set(this.users, index, user);
            Vue.set(this.filteredUsers, index, user);
          });
        })
        .catch(error => {
          console.log("Error while fetching users");
          console.log(error);
        })
    },
    filterUsers: function(){
      if (this.userSearch.length > 0) {
        this.filteredUsers = _.filter(this.users, (user) => {
          if (user.username == this.userSearch) {
            return true;
          } else if (user.name == this.userSearch) {
            return true;
          } else if (user.email == this.userSearch) {
            return true;
          } else {
            return false;
          }
        })
      } else {
        this.filteredUsers = this.users;
      }
    },
    closeUserView: function(){
      this.selectedUser = null;
      this.getUsers();
    }
  },
  components: {
    'user-view': UserView
  }
})
