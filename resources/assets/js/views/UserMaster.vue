<template lang="html">
  <div class="column is-paddingless">
    <section class="section">
      <nav class="level">
        <div class="level-left">
          <div class="level-item">
            <div class="field has-addons">
              <p class="control">
                <input class="input" type="text" v-model="userSearch" placeholder="Find a user">
              </p>
              <p class="control">
                <button class="button" @click="filterUsers">
                  Search
                </button>
              </p>
            </div>
          </div>
        </div>
      </nav>
      <table class="table is-fullwidth">
        <thead>
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Name</th>
            <th>Email ID</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for='user in filteredUsers'>
            <td>{{ user.id }}</td>
            <td>{{ user.username }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td><a class="button is-small" @click="selectedUser = user">View</a></td>
          </tr>
        </tbody>
      </table>
    </section>
    <user-view
      :user="selectedUser"
      :show-view="selectedUser != null"
      v-if="selectedUser != null"
      @close-user-view="closeUserView">
    </user-view>
  </div>
</template>

<script>
import UserView from './UserView.vue';

export default {
  data: function() {
    return {
      users: [],
      userSearch: "",
      filteredUsers: [],
      selectedUser: null,
    }
  },
  created: function() {
    this.getUsers();
  },
  methods: {
    getUsers: function(){
      axios.get('/api/users')
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
}
</script>

<style lang="scss">
</style>
