<template>
    <nav class="navbar is-primary" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <a class="navbar-item" @click="toggleMenu"><i class="fa fa-bars"></i></a>
      </div>
      <div class="navbar-brand">
        <a class="navbar-item nav-title">
          User Management Portal
        </a>
      </div>
      <div class="navbar-end">
        <div class="navbar-item has-dropdown" :class="{'is-active': dropdown}">
          <a class="navbar-link" @click="dropdown = !dropdown">
            <span class="icon is-left">
              <i class="fa fa-user-o"></i>
            </span>
            <span>username</span>
          </a>
          <div class="navbar-dropdown is-right">
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
export default {
  data: function(){
    return {
      dropdown: false,
    }
  },
  methods: {
    toggleMenu: function(){
      this.$emit('toggle-menu');
    },
    logout: function(){
      this.$emit('logout');
    }
  }
}
</script>

<style lang="css">
</style>
