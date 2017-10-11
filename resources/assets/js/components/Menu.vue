<template>
  <aside class="menu">
    <p class="menu-label">
      Menu
    </p>
    <ul class="menu-list">
      <li><a @click="redirect('/home')">Dashboard</a></li>
      <li><router-link active-class="is-active" :to="{ name: 'users' }">Users</router-link></li>
      <li><router-link active-class="is-active" :to="{ name: 'roles' }">Roles</router-link></li>
    </ul>
  </aside>
</template>

<script>
import router from '../Routes';

export default {
  data: function(){
    return {
      menuItems: []
    }
  },
  router: router,
  created: function(){
    this.menuItems.push('Home');
    this.menuItems.push('User');
    this.menuItems.push('Role');
    console.log("Menu Created");
  },
  methods: {
    redirect: function(path){
      location.href = path;
    },
    hasPermission: function(permission) {

    }
  }
}
</script>

<style lang="scss"></style>
