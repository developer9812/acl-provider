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

          <div class="field">
            <label class="label">Name</label>
            <div class="control">
              <input class="input" type="text" v-model="form.name" @change="removeError('name')" @blur="validate('name',form)">
              <!-- <span class="icon is-small is-left">
                <i class="fa fa-user"></i>
              </span> -->
            </div>
            <p class="help is-danger" v-if="errormsg.hasOwnProperty('name')">{{ getError('name') }}</p>
            <!-- <p class="help is-danger" v-if="errors.hasOwnProperty('username')">{{ getError("username") }}</p> -->
          </div>

          <div class="field">
            <label class="label">Username</label>
            <div class="control">
              <input class="input" type="text" v-model="form.username" @change="removeError('username')" @blur="validate('username',form)">
              <!-- <span class="icon is-small is-left">
                <i class="fa fa-user"></i>
              </span> -->
            </div>
            <p class="help is-danger" v-if="errormsg.hasOwnProperty('username')">{{ getError('username')}}</p>
            <!-- <p class="help is-danger" v-if="errors.hasOwnProperty('username')">{{ getError("username") }}</p> -->
          </div>

          <div class="field">
            <label class="label">Email</label>
            <div class="control">
              <input class="input" type="email" v-model="form.email" @change="removeError('email')" @blur="validate('email',form)">
              <!-- <span class="icon is-small is-left">
                <i class="fa fa-user"></i>
              </span> -->
            </div>
            <p class="help is-danger" v-if="errormsg.hasOwnProperty('email')">{{ getError('email')}}</p>
            <!-- <p class="help is-danger" v-if="errors.hasOwnProperty('username')">{{ getError("username") }}</p> -->
          </div>

          <div class="field">
            <label class="label">Password</label>
            <div class="control">
              <input class="input" type="password" v-model="form.password" @change="removeError('password')" @blur="validate('password', form)">
              <!-- <span class="icon is-small is-left">
                <i class="fa fa-lock"></i>
              </span> -->
            </div>
                      <p class="help is-danger" v-if="errormsg.hasOwnProperty('password')">{{ getError("password") }}</p>
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
            <p class="control">
              <button class="button is-fullwidth is-primary register-submit" @click="registerUser">
                <h3>Register</h3>
              </button>
            </p>
          </div>
          <!-- <div v-if="error" class="notification is-danger">
            <p>{{ message }}</p>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Validate from '../services/Validate';
import Auth from '../services/Auth';

export default{
  data: function(){
    return {
      form :{
        name:"",
        username: "",
        email: "",
        password: "",
        password_confirmation: ""
      },
      errormsg: []
    }
  },
  methods: {
    getError: function(field){
      if(typeof(this.errormsg[field]) !== 'undefined'){
        if(this.errormsg[field]){
          return this.errormsg[field]['message'];
        }
      }
    },
    removeError: function(field){
      if(typeof(this.errormsg[field]) !== 'undefined'){
        this.errormsg[field]['hasError'] = false;
        this.errormsg[field]['message'] = '';
      }
    },
    // removeError: function(field){
    //   let index = '';
    //   for(let i=0; i< this.errormsg.length; i++){
    //     for(let key in this.errormsg[i]){
    //       if(this.errormsg[i][key] == field){
    //         index = this.errormsg.indexOf(this.errormsg[i]);
    //         if(index > -1){
    //             this.errormsg.splice(index, 1);
    //         }
    //         // return this.errormsg[i]['errormsg'];
    //       }
    //     }
    //   }
    // },
    validate: function(formfield, formdata){
      let validation = new Validate();
      // console.log(validation.validateData(formfield, formdata));
      let errorObj = validation.validateData(formfield, formdata);
      if(errorObj.hasError){
        console.log("has Error");
        console.log(errorObj.hasError);
        Vue.set(this.errormsg, formfield, errorObj);
        // this.errormsg[formfield] = errorObj;
      }
      console.log("ERROR ARRAY");
      console.log(this.errormsg);
    },
    registerUser: function(){
      axios.post('/register', this.form).
      then(response => {
        let path = this.$store.getters.intendedPath;
        this.$store.commit('setIntendedPath', '/');
        Auth.setPermissions();
        // this.$router.go()
        this.$router.push('/profile/create');
      }).
      catch(error => {
        console.log(error);
      });
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
  background-image: url('../../images/background.png');
  background-repeat: no-repeat;
  padding: 2rem;
  overflow: auto;
  .image{
    img{
      margin: 20px auto;
      width: 300px;
    }
  }
  .section{
    padding: 0.01rem 1.5rem;
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
