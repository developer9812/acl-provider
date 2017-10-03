require('./bootstrap');
import RoleView from './user/RoleView.vue'

var vm = new Vue({
  el: '#app',
  data: {
    newRole: false,
    roleName: '',
    error: false,
    roles: [],
    selectedRole: null,
    roleSearch: '',
    filteredRoles: []
  },
  created: function(){
    console.log(this.testMessage);
    this.getRoles();
  },
  methods: {
    addNewRole: function(){
      this.newRole = true;
    },
    saveRole: function(){
      if (this.roleName.length > 0){
        axios.post('/user/roles/create', {
          role_name: this.roleName
        }).then(response => {
          console.log("RESPONSE");
          console.log(response);
          this.newRole = false;
          this.getRoles();
        }).catch(error => {
          console.log("ERROR");
          console.log(error);
        })
      } else {
        this.error = true;
      }
    },
    filterRoles: function(){
      if (this.roleSearch.length > 0) {
        this.filteredRoles = _.filter(this.roles, (role) => {
          return role.name == this.roleSearch;
        })
      } else {
        this.filteredRoles = this.roles;
      }
    },
    clearSearch: function(){
      this.filteredRoles = this.roles;
      this.roleSearch = "";
    },
    getRoles: function(){
      axios.get('/user/roles/get')
        .then(response => {
          console.log("RESPONSE");
          console.log(response);
          this.roles = response.data;
          this.filteredRoles = this.roles;
        })
        .catch(error => {
          console.log("ERROR");
          console.log(error);
        });
    },
    closeRoleView: function(){
      this.selectedRole = null;
      this.getRoles();
    }
  },
  components: {
    'role-view': RoleView
  }
})
