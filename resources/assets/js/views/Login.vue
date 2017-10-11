<template lang="html">
  <div id="page-background">
    <div class="columns is-centered">
      <div class="column is-4 is-narrow">
        <picture class="image">
          <img src="images/worsworthelt.svg">
        </picture>
        <div class="section login-form">
          <!-- <div class="level">
            <h4 class="title is-4 level-item">Login</h4>
          </div> -->
          <div class="field">
            <!-- <label class="label">Username</label> -->
            <div class="control has-icons-left has-icons-right">
              <input class="input" type="text" placeholder="Username/Email" v-model="form.username">
              <span class="icon is-small is-left">
                <i class="fa fa-user"></i>
              </span>
              <span class="icon is-small is-right">
                <i class="fa fa-check"></i>
              </span>
            </div>
          </div>
          <div class="field">
            <!-- <label class="label">Password</label> -->
            <div class="control has-icons-left has-icons-right">
              <input class="input" type="password" placeholder="Password" v-model="form.password">
              <span class="icon is-small is-left">
                <i class="fa fa-lock"></i>
              </span>
              <span class="icon is-small is-right">
                <i class="fa fa-check"></i>
              </span>
            </div>
          </div>
          <div class="field">
            <p class="control">
              <a class="button is-block is-primary login-submit" @click="submit">
                Log in
              </a>
            </p>
          </div>
          <div class="field level">
            <div class="level-left">
              <p class="level-item">
                <label class="checkbox">
                  <input type="checkbox">
                  Remember me
                </label>
              </p>
            </div>
            <div class="level-right">
              <p class="level-item">
                <a href="#">Forgot Password ?</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function(){
    return {
      form: {
        username: "",
        password: ""
      }
    }
  },
  methods: {
    submit: function(){
      axios.post('/login', this.form)
      .then(response => {
        console.log("RESPONSE");
        console.log(response);
        this.$router.push();
      })
      .catch(error => {
        console.log("ERROR");
        console.log(error);
      })
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
    margin-top: 5rem;
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
