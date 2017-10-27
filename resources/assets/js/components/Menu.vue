<template>
  <aside class="menu">
    <p class="menu-label">
      <span>Menu</span>
    </p>
    <ul class="menu-list">
      <li><router-link active-class="is-active" :to="{ name: 'home'}" exact>
            <span class="icon is-left"><i class="fa fa-tachometer"></i></span><span class="menu-text">Dashboard</span>
          </router-link></li>
      <li v-can:view-user><router-link  active-class="is-active" :to="{ name: 'users' }" exact>
        <span class="icon is-left "><i class="fa fa-users"></i></span><span class="menu-text">Users</span>
      </router-link></li>
      <li v-can:view-role><router-link active-class="is-active" :to="{ name: 'roles' }" exact>
        <span class="icon is-left"><i class="fa fa-user-circle-o"></i></span><span class="menu-text">Roles</span>
      </router-link></li>
    </ul>
  </aside>
</template>

<script>
import router from '../Routes';
import Permission from '../services/Permission';

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

<style lang="scss">
  .menu-label{
    padding: 1rem 0 0 1rem;
  }
  .menu-text{
    margin-left: 0.5rem;
  }
</style>
