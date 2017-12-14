<template lang="html">
  <div id="page-background">
    <div class="columns is-centered">
      <div class="column is-4 is-narrow">
        <picture class="image">
          <img src="/images/worsworthelt.svg">
        </picture>
        <div class="section register-form">
          <!-- <div class="level">
            <h4 class="title is-4 level-item">Login</h4>
          </div> -->

          <div class="content">
            <!-- <p><a class="button is-primary is-outlined" @click="backToLogin">
              <span class="icon"><i class="fa fa-arrow-left"></i></span>
              <span>Login</span>
            </a></p> -->
            <h4 class="title is-4">Create Account</h4>
          </div>
          <div class="field">
            <label class="label">Username</label>
            <div class="control">
              <input class="input" type="text" v-model="form.username" @change="removeError('username')" >
              <!-- <span class="icon is-small is-left">
                <i class="fa fa-user"></i>
              </span> -->
            </div>
            <p class="help is-danger" v-if="errors.hasOwnProperty('username')">{{ getError('username')}}</p>
            <!-- <p class="help is-danger" v-if="errors.hasOwnProperty('username')">{{ getError("username") }}</p> -->
          </div>

          <div class="field">
            <label class="label">Email</label>
            <div class="control">
              <input class="input" type="email" v-model="form.email" @change="removeError('email')" >
              <!-- <span class="icon is-small is-left">
                <i class="fa fa-user"></i>
              </span> -->
            </div>
            <p class="help is-danger" v-if="errors.hasOwnProperty('email')">{{ getError('email')}}</p>
            <!-- <p class="help is-danger" v-if="errors.hasOwnProperty('username')">{{ getError("username") }}</p> -->
          </div>

          <div class="field">
            <label class="label">Password</label>
            <div class="control">
              <input class="input" type="password" v-model="form.password" @change="removeError('password')" >
              <!-- <span class="icon is-small is-left">
                <i class="fa fa-lock"></i>
              </span> -->
            </div>
            <p class="help is-danger" v-if="errors.hasOwnProperty('password')">{{ getError("password") }}</p>
            <!-- <p class="help is-danger" v-if="errors.hasOwnProperty('password')">{{ getError("password") }}</p> -->
          </div>

          <div class="field">
            <label class="label">Confirm Password</label>
            <div class="control">
              <input class="input" type="password" v-model="form.password_confirmation">
              <!-- <span class="icon is-small is-left">
                <i class="fa fa-lock"></i>
              </span> -->
            </div>
            <!-- <p class="help is-danger" v-if="errors.hasOwnProperty('password')">{{ getError("password") }}</p> -->
          </div>

          <div class="field">
            <div class="columns">
              <div class="column">
                <p class="control">
                  <button class="button is-fullwidth is-primary register-submit" @click="registerUser">
                    <h3>Register</h3>
                  </button>
                </p>
              </div>
              <div class="column">
                <p class="control">
                  <button class="button is-fullwidth is-primary register-submit" @click="cancel">
                    <h3>Cancel</h3>
                  </button>
                </p>
              </div>
            </div>
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

export default{
  data: function(){
    return {
      form :{
        username: "",
        email: "",
        password: "",
        password_confirmation: ""
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
    removeError: function(field){
      if(this.errors[field]) {
        delete this.errors[field];
      }
    },
    registerUser: function(){
      axios.post('/register', this.form).
      then(response => {
        let path = this.$store.getters.intendedPath;
        this.$store.commit('setIntendedPath', '/');
        Auth.setPermissions();
        // this.$router.go()
        this.$router.replace({name: 'create-profile'});
      }).
      catch(error => {
        console.log(error);
        this.setError(error);
      });
    },
    cancel: function(){
      this.$router.go(-1);
    },
    setError: function(error){
      if (error.response.status == 422){
        this.message = error.response.data.message;
        this.errors = error.response.data.errors;
        this.error = true;
      } else {
        this.message = error.response.data.message;
        this.error = true;
      }
      setTimeout(() => {
        this.error = false;
        this.message = "";
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

<style lang="scss" >
#page-background {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: whitesmoke;
  // background-image: url('../../images/background.png');
  // background-repeat: no-repeat;
  padding: 2rem;
  overflow: auto;
  .image{
    img{
      margin: auto;
      width: 300px;
    }
  }
  .section{
    // padding: 0.01rem 1.5rem;
  }
  .register-form{
    margin-top: 3rem;
    background-color: white;
    box-shadow: 0px 0px 8px 0px grey;
    border-radius: 3px;
    .field {
      margin-top: 1.5rem;
      .register-submit{
        text-transform: uppercase;
        font-weight: 600;
      }
    }
  }
}
</style>
