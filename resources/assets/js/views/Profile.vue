<template>
  <div class="container">
    <div class="level">
      <div class="level-item title is-4" style="margin-top: 20px;">
        Profile
      </div>
    </div>
    <div class="section">
      <div class="columns is-centered">
        <div class="column is-8">
          <div class="columns">
            <div class="column is-narrow">
              <div class="control">
                <div class="select">
                  <select class="input is-primary" name="" v-model="form.profile.title" @change="getTitle">
                    <option value="Mr" > Mr. </option>
                    <option value="Mrs"> Mrs. </option>
                    <option value="Miss"> Miss </option>
                  </select>
                </div>
              </div>
            </div>
            <div class="column">
              <div class="control">
                <input type="text" class="input is-primary" name="" v-model="form.profile.firstname" placeholder="First Name" value="">
              </div>
            </div>
            <div class="column">
              <div class="control">
                <input type="text" class="input is-primary" name="" v-model="form.profile.middlename" placeholder="Middle Name" value="">
              </div>
            </div>
            <div class="column">
              <div class="control">
                <input type="text" class="input is-primary" name="" v-model="form.profile.lastname" placeholder="Last Name" value="">
              </div>
            </div>
            <div class="column">
              <div class="control">
                <input type="text" class="input is-primary" name="" v-model="form.profile.nickname" placeholder="Nick Name" value="">
              </div>
            </div>
          </div>

          <div class="columns">
            <div class="column">
              <div class="field">
                <label for="" class="title is-6"> Date Of Birth </label>
                <div class="control">
                  <input type="text" class="input is-primary" name="" v-model="form.profile.dob" value="" placeholder="Enter Birthdate">
                </div>
              </div>
            </div>
            <div class="column">
              <div class="field">
                <label for="" class="title is-6"> Gender </label>
                <div class="control">
                  <label for="" class="radio">
                    <input class="is-primary" type="radio" v-model="form.profile.gender" name="gender" value="male"> Male
                  </label>
                  <label for="" class="radio">
                      <input class="is-primary" type="radio" v-model="form.profile.gender" name="gender" value="female"> Female
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div class="columns">
            <div class="column">
              <label class="title is-6"> Phone </label>
              <div class="field has-addons is-12">
                <p class="control">
                  <span class="select">
                    <select class="input is-primary">
                      <option> +91 </option>
                      <option> +079 </option>
                    </select>
                  </span>
                </p>
                <!-- <label for=""> Phone No. </label> -->
                <span class="control">
                  <input type="text" class="input is-primary" v-model="form.profile.phoneno" placeholder="phone number" name="" value="">
                </span>
              </div>
            </div>

            <div class="column">
              <div class="field">
                <label for="" class="title is-6"> Email </label>
                <div class="control">
                  <input type="email" placeholder="eg. abc@example.com" v-model="form.profile.email" class="input is-primary" name="" value="">
                </div>
              </div>
            </div>
          </div>

          <div class="columns">
            <div class="column">
              <address-component title="Permanent Address" v-on:show-detail="getAddress"></address-component>
            </div>

            <div class="column">
              <address-component title="Present Address"></address-component>
            </div>
          </div>

          <div class="columns">
            <div class="column">
              <div class="columns">
                <div class="column">
                  <div class="field is-grouped">
                    <div class="control">
                      <a @click="saveProfile" class="button is-primary" >
                        <span class="icon">
                          <i class="fa fa-check"></i>
                        </span>
                        <span>Save</span>
                      </a>
                    </div>
                    <div class="control">
                      <a class="button is-primary">
                        <span class="icon is-left">
                          <i class="fa fa-times"></i>
                        </span>
                        <span>Cancel</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="column">
              <div class="field is-pulled-right">
                <div class="control">
                  <button @click="skipProfile" class="button is-primary" type="button" name="button">
                    <span>Skip</span>
                    <span class="icon">
                      <i class="fa fa-arrow-right"></i>
                    </span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
</template>

<script>
import AddressComponent from './partials/Address.vue';
export default{
  data: function(){
    return{
      form: {
        profile: {
          title: 'Mr',
          firstname: '',
          middlename: '',
          lastname: '',
          dob: '',
          picture: '',
          gender: '',
          phoneno: '',
          email: '',
        },
        relations: {
          permanentAddress: {},
          residenceAddress: {}
        }
      }
    }
  },
  created: function(){
    axios.post("http://192.168.1.65/IndiaGuideService/index.php/getStates",{})
    .then(response => {
      console.log(response.data);
    })
    .catch(error => {
      console.log(error);
    })
  },
  methods:{
    getTitle: function(){
        console.log(this.form.profile.title);
    },
    showAddress: function(){
      this.show = !(this.show);
    },
    getAddress: function(address){
      this.form.relations.permanentAddress = address;
    },
    skipProfile: function(){
      console.log(this.$store.getters.intendedPath);
      let path = this.$store.getters.intendedPath;
      this.$router.push(path);
      // this.$router.go('-1');
    },
    saveProfile: function(){
      axios.post('', this.form)
      .then(response => {
        console.log(response.status);
      })
      .catch(error => {
        console.log(error);
      })
    }
  },
  mounted: function(){
    console.log("MOUNTED");
    console.log(this.form.relations.permanentAddress);
    // this.$on('show-detail', function(value){
    //   console.log(value);
    // });
  },
  components: {
    'address-component': AddressComponent
  }

}
</script>
