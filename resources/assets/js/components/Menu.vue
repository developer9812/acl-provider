<template>
  <aside class="menu">
    <p class="menu-label">
      Menu
    </p>
    <ul class="menu-list">
      <li><a @click="redirect('/home')">Dashboard</a></li>
      <li><a @click="redirect('/user')">Users</a></li>
      <li><a @click="redirect('/user/roles')">Roles</a></li>
    </ul>
  </aside>
</template>

<script>
export default {
  data: function(){
    return {
      menuItems: []
    }
  },
  created: function(){
    this.menuItems.push('Home');
    this.menuItems.push('User');
    this.menuItems.push('Role');
    console.log("Menu Created");
  },
  methods: {
    redirect: function(path){
      location.href = path;
    }
  }
}
</script>

<style lang="scss">
</style>
