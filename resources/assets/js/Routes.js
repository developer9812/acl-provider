require('./bootstrap');
import VueRouter from 'vue-router';
import Main from './views/Main.vue';
import User from './views/UserMaster.vue';
import Role from './views/RoleMaster.vue';
import Login from './views/Login.vue';

Vue.use(VueRouter);
var router = new VueRouter({
  routes: [
    {
      path: '/',
      component: Main,
      children: [
        {
          name: 'users',
          path: '/users',
          component: User,
        },
        {
          name: 'roles',
          path: '/roles',
          component: Role
        }
      ]
    },
    {
      path: '/login',
      component: Login
    }
  ]
});

// router.beforeEach((to, from, next) => {
//
// });

export default router;
