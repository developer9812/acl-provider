<style media="screen" lang="scss">
  .name-title{
    width: 3rem;
  }
</style>

<template>
  <div class="">
    <div class="level">
      <div class="level-item title is-4" style="margin-top: 20px;">
        Profile
      </div>
    </div>
    <div class="section">
        <div class="columns is-centered">
          <div class="column is-8">
            <div class="field">
              <label for="" class="title is-6"> Name </label>
              <div class="columns">
                <div class="column is-narrow">
                  <div class="control">
                    <div class="select">
                      <select class="" name="" v-model="user.title" @change="getTitle">
                        <option :value="Mr" > Mr. </option>
                        <option :value="Mrs"> Mrs. </option>
                        <option :value="Miss"> Miss </option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="column">
                  <div class="control">
                    <input type="text" class="input" name="" placeholder="First Name" value="">
                  </div>
                </div>
                <div class="column">
                  <div class="control">
                    <input type="text" class="input" name="" placeholder="Middle Name" value="">
                  </div>
                </div>
                <div class="column">
                  <div class="control">
                    <input type="text" class="input" name="" placeholder="Last Name" value="">
                  </div>
                </div>

              </div>

            </div>

            <div class="field">
              <div class="columns">
                <div class="column">
                  <label for="" class="title is-6"> Date Of Birth </label>
                  <div class="control">
                    <input type="text" class="input" name="" value="" placeholder="Enter Birthdate">
                  </div>
                </div>
                <div class="column">
                  <label for="" class="title is-6"> Gender </label>
                  <div class="control">
                    <label for="" class="radio">
                      <input type="radio" name="gender" value="male"> Male
                    </label>
                    <label for="" class="radio">
                        <input type="radio" name="gender" value="female"> Female
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="columns">
              <div class="column">
                <div class="field">
                  <label for="" class="title is-6"> Phone </label>
                </div>
                <div class="field has-addons">
                  <p class="control">
                    <span class="select">
                      <select>
                        <option> +91 </option>
                        <option> +079 </option>
                      </select>
                    </span>
                  </p>
                  <!-- <label for=""> Phone No. </label> -->
                  <span class="control">
                    <input type="text" class="input" placeholder="phone number" name="" value="">
                  </span>
                </div>
              </div>

              <div class="column">
                <div class="field">
                  <label for="" class="title is-6"> Email </label>
                  <div class="control">
                    <input type="email" placeholder="eg. abc@example.com" class="input" name="" value="">
                  </div>
                </div>
              </div>
            </div>

            <div class="field">
              <div class="control">
                <div class="card">
                  <header class="card-header" @click="showAddress">
                    <p class="card-header-title">
                      Present Address
                    </p>
                    <a href="#" class="card-header-icon">
                      <span class="icon">
                        <i class="fa fa-angle-down"></i>
                      </span>
                    </a>
                  </header>
                  <div class="" v-if="show">
                    <div class="card-content" >
                      <div class="content">
                        <div class="control columns">
                          <div class="column is-2">
                            <input type="text" class="input" placeholder="house" name="" value="">
                          </div>
                          <div class="column is-5">
                            <input type="text" class="input" placeholder="building" name="" value="">
                          </div>
                          <div class="column is-5">
                            <input type="text" class="input" placeholder="street" name="" value="">
                          </div>
                        </div>

                        <div class="control columns">
                          <div class="column is-4">
                            <input type="text" class="input" placeholder="landmark" name="" value="">
                          </div>
                          <div class="column is-4">
                            <input type="text" class="input" placeholder="pincode" name="" value="">
                          </div>
                          <div class="column is-4">
                            <input type="text" class="input" placeholder="city" name="" value="">
                          </div>
                        </div>

                        <div class="control columns">
                          <div class="column is-4">
                            <input type="text" class="input" disabled="disabled" placeholder="state" value="Gujarat" name="">
                          </div>
                          <div class="column is-4">
                            <input type="text" class="input" disabled="disabled" placeholder="country" name="" value="India">
                          </div>
                        </div>

                      </div>
                    </div>
                    <footer class="card-footer">
                      <a href="#" class="card-footer-item">Save</a>
                      <a href="#" class="card-footer-item">Edit</a>
                      <a href="#" class="card-footer-item">Delete</a>
                    </footer>
                  </div>

                </div>
              </div>
            </div>

          </div>


          <!-- <div class="column">

          </div> -->
        </div>
    </div>
  </div>

</template>

<script>

export default{
  data: function(){
    return{
      show: false,
      user: {
        title: 'Mr'
      }
    }
  },
  methods:{
    getTitle: function(){
        console.log(this.user.title);
    },
    showAddress: function(){
      this.show = !(this.show);

    }
  }

}
</script>
