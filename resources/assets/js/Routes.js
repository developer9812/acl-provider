require('./bootstrap');
import VueRouter from 'vue-router';
import Auth from './services/Auth';
import Main from './views/Main.vue';
import User from './views/UserMaster.vue';
import Role from './views/RoleMaster.vue';
import Login from './views/Login.vue';
import store from './store';
import Register from './views/Register.vue';
import Profile from './views/Profile.vue';
import ViewProfile from './views/ViewProfile.vue';

import Test from './views/Test.vue';

Vue.use(VueRouter);
var router = new VueRouter({
  mode: 'history',
  routes: [
    {
      name: 'home',
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
          component: Role,
        },
        {
          name: 'profile',
          path: '/profile',
          component: Profile
        },
        {
          name: 'test',
          path: '/test',
          component: Test
        },
        {
          name: 'viewprofile',
          path: '/viewProfile',
          component: ViewProfile
        }
      ]
    },
    {
      name: 'login',
      path: '/auth/login',
      component: Login
    },
    {
      name: 'register',
      path: '/auth/register',
      component: Register
    }
  ]
});

router.beforeEach((to, from, next) => {
  console.log("ROUTE TO");
  console.log(to);
  if (to.name == 'login') {
    console.log(store.getters.intendedPath);
    // Auth.logout();
    next();
  } else if(to.name == 'register'){
    Auth.logout();
    next();
  } else {
    Auth.isAuthenticated()
      .then(
        status => {
          console.log("ROUTE RESPONSE");
          console.log(status);
          if (status) {
            next();
          } else {
            // location.reload();
            store.commit('setIntendedPath', to.fullPath);
            next({
              name: 'login'
            })
          }
        })
  }
});

export default router;
