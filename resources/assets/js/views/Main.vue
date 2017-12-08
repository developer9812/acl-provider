<template lang="html">
  <div class="app">
    <navbar-view
      @toggle-menu="toggleMenu"
      @logout="logout">
    </navbar-view>
    <div class="columns main-content is-marginless">
      <div class="column is-narrow menu-container is-paddingless">
        <transition name="slide">
          <menu-view v-if="showMenu"></menu-view>
        </transition>
      </div>
      <div class="column page-content is-paddingless">
           <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
import Menu from '../components/Menu.vue'
import Navbar from './Navbar.vue'

export default {
  data: function(){
    return {
      showMenu:false
    }
  },
  methods: {
    toggleMenu: function(){
      this.showMenu = !this.showMenu;
    },
    logout: function(){
      axios.post('/logout')
        .then(response => {
          console.log("MAIN RESPONSE");
          console.log(response);
          location.reload();
          this.$store.commit('intendedPath', '/');
          this.$router.push({name: 'login'});
        })
        .catch(error => {
          console.log("ERROR");
          console.log(error);
          location.reload();
        })
    }
  },
  components: {
    'menu-view': Menu,
    'navbar-view': Navbar
  }
}

</script>

<style lang="scss">
</style>
