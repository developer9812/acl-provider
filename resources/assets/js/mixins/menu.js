import MenuView from '../components/Menu.vue';

module.exports = {
  data: function(){
    return {
      showMenu: false,
    }
  },
  methods: {
    toggleMenu: function(){
      this.showMenu = !this.showMenu;
    }
  },
  components: {
    'menu-view': MenuView
  }
}
