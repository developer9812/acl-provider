<template>
    <nav class="navbar is-primary" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <a class="navbar-item" @click="toggleMenu"><i class="fa fa-bars"></i></a>
      </div>
      <div class="navbar-brand">
        <a class="navbar-item nav-title">
          User Accounts Management
        </a>
      </div>
      <div class="navbar-end">
        <div class="navbar-item has-dropdown" :class="{'is-active': dropdown}">
          <a class="navbar-link" @click="dropdown = !dropdown">
            <span class="icon is-left">
              <i class="fa fa-user-o"></i>
            </span>
            <span> {{ name }}</span>
          </a>
          <div class="navbar-dropdown is-right">
            <a class="navbar-item" @click="editProfile">
              <span class="icon is-left">
                <i class="fa fa-user"></i>
              </span>
              <span>Profile</span>
            </a>
            <a class="navbar-item">
              <span class="icon is-left">
                <i class="fa fa-cog"></i>
              </span>
              <span>Settings</span>
            </a>
            <hr class="navbar-divider">
            <a class="navbar-item" @click="logout">
              <span class="icon is-left">
                <i class="fa fa-sign-out"></i>
              </span>
              <span>Logout</span>
            </a>
          </div>
        </div>
      </div>
    </nav>
</template>

<script>

import Auth from '../services/Auth';

export default {
  data: function(){
    return {
      name: '',
      dropdown: false,
    }
  },
  created: function(){
    console.log("NAVBAR CREATED");
    // this.username = this.$store.getters.username;
  },
  mounted: function(){
    axios.get('/api/user/detail')
    .then(response => {
      this.name = response.data.name;
    })
    .catch(error => {
      console.log(error);
    })
  },
  methods: {
    toggleMenu: function(){
      this.$emit('toggle-menu');
    },
    logout: function(){
      Auth.logout();
      this.$emit('logout');
    },
    editProfile: function(){
      this.dropdown = !(this.dropdown);
      this.$router.push('/profile');
    }
  }
}
</script>

<style lang="css">
</style>
