<template lang="html">
  <div id="page-background">
    <div class="columns is-centered">
      <div class="column is-4 is-narrow">
        <picture class="image">
          <img src="/images/worsworthelt.svg">
        </picture>
        <div class="section login-form">
          <!-- <div class="level">
            <h4 class="title is-4 level-item">Login</h4>
          </div> -->
          <div class="field">
            <!-- <label class="label">Username</label> -->
            <div class="control has-icons-left has-icons-right">
              <input class="input" type="text" placeholder="Username/Email"
                :class="{'is-danger': errors.hasOwnProperty('username')}"
                v-model="form.username">
              <span class="icon is-small is-left">
                <i class="fa fa-user"></i>
              </span>
              <!-- <span class="icon is-small is-right">
                <i class="fa fa-check"></i>
              </span> -->
            </div>
            <p class="help is-danger" v-if="errors.hasOwnProperty('username')">{{ getError("username") }}</p>
          </div>
          <div class="field">
            <!-- <label class="label">Password</label> -->
            <div class="control has-icons-left has-icons-right">
              <input class="input" type="password" placeholder="Password"
                :class="{'is-danger': errors.hasOwnProperty('password')}"
                v-model="form.password">
              <span class="icon is-small is-left">
                <i class="fa fa-lock"></i>
              </span>
              <!-- <span class="icon is-small is-right">
                <i class="fa fa-check"></i>
              </span> -->
            </div>
            <p class="help is-danger" v-if="errors.hasOwnProperty('password')">{{ getError("password") }}</p>
          </div>
          <div class="field level">
            <div class="level-left">
              <p class="level-item">
                <label class="checkbox">
                  <input type="checkbox" v-model="form.remember">
                  Remember me
                </label>
              </p>
            </div>
            <div class="level-right">
              <p class="level-item">
                <a>Forgot Password ?</a>
              </p>
            </div>
            <div class="level-right">
              <p class="level-item">
                <a @click="register">Register</a>
              </p>
            </div>
          </div>
          <div class="field">
            <p class="control">
              <button class="button is-fullwidth is-primary login-submit" @click="submit">
                Log in
              </button>
            </p>
          </div>
          <div class="field">
            <p class="control">
              <button class="button is-outlined is-info" @click="googleLogin">
                <span class="icon">
                  <i class="fa fa-google"></i>
                </span>
                <span>Sign in with Google</span>
              </button>
            </p>
          </div>
          <div v-if="error" class="notification is-danger">
            <p>{{ message }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Auth from '../services/Auth';

export default {
  data: function(){
    return {
      form: {
        username: "",
        password: "",
        remember: true,
      },
      message: '',
      error: false,
      errors: []
    }
  },
  methods: {
    getError: function(field) {
      if(this.errors[field]) {
        return this.errors[field][0];
      }
    },
    submit: function(){

      /*Auth.login(this.form).then(
        () => {
          let path = this.$store.getters.intendedPath;
          this.$store.commit('setIntendedPath', '/');
          Auth.setPermissions();
          this.$router.push(path);
        },
        error => {
          console.log("ERROR");
          this.setError(error);
        });*/

      axios.post('/login', this.form)
      .then(response => {
        let path = this.$store.getters.intendedPath;
        // this.$store.commit('setUsername', this.form.username);
        this.$store.commit('setIntendedPath', '/');
        Auth.setPermissions();
        this.$router.push(path);
      })
      .catch(error => {
        console.log("ERROR");
        this.setError(error);
        console.log(error);
      });

    },
    register: function(){
        this.$router.push({ name: 'register'});
    },
    googleLogin: function(){
      window.location.href = "/auth/social/google";
    },
    setError: function(error){
      this.message = error.response.data.message;
      this.errors = error.response.data.errors;
      this.error = true;
      setTimeout(() => {
        this.error = false;
      }, 5000);
    }
  },
  watch: {
    form: {
      handler: function(){
        this.errors = [];
        this.error = false;
      },
      deep: true
    }
  }
}
</script>

<style lang="scss">
#page-background {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('../../images/background.png');
  background-repeat: no-repeat;
  padding: 1rem;
  .image{
    img{
      margin: 20px auto;
      width: 300px;
    }
  }
  .login-form{
    margin-top: 3rem;
    background-color: white;
    box-shadow: 0px 0px 8px 0px grey;
    border-radius: 3px;
    .field {
      margin-top: 1.5rem;
      .login-submit{
        text-transform: uppercase;
        font-weight: 600;
      }
    }
  }
}
</style>
