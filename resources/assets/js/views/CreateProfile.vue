<template>
<div class="container">
  <div class="level">
    <div class="level-item title is-4" style="margin-top: 20px;">
      Add Personal Information
    </div>
  </div>
  <div class="section">
    <div class="columns is-centered">
      <div class="column is-8">
        <div class="columns control">
          <div class="column is-narrow">
            <div class="control">
              <div class="select">
                <select class="input" name="" v-model="form.profile.title" @change="getTitle">
                    <option value="Mr" > Mr. </option>
                    <option value="Mrs"> Mrs. </option>
                    <option value="Miss"> Miss </option>
                  </select>
              </div>
            </div>
          </div>
          <div class="column">
            <div class="control">
              <input type="text" class="input" name="" v-model="form.profile.first_name" placeholder="First Name" value="">
            </div>
          </div>
          <div class="column">
            <div class="control">
              <input type="text" class="input" name="" v-model="form.profile.middle_name" placeholder="Middle Name" value="">
            </div>
          </div>
          <div class="column">
            <div class="control">
              <input type="text" class="input" name="" v-model="form.profile.last_name" placeholder="Last Name" value="">
            </div>
          </div>
          <div class="column">
            <div class="control">
              <input type="text" class="input" name="" v-model="form.profile.nick_name" placeholder="Nick Name" value="">
            </div>
          </div>
        </div>

        <div class="columns control">
          <div class="column">
            <div class="field">
              <label for="" class="title is-6"> Date Of Birth </label>
              <div class="control">
                <v-date-picker mode='single' :theme-styles='themeStyles' inputClass='input' v-model='form.profile.dob'></v-date-picker>
                <!-- <input type="text" class="input is-primary" name="" v-model="form.profile.dob" value="" placeholder="Enter Birthdate"> -->
              </div>
            </div>
          </div>
          <div class="column">
            <div class="field">
              <label for="" class="title is-6"> Gender </label>
              <div class="control">
                <label for="" class="radio">
                    <input type="radio" v-model="form.profile.gender" name="gender" value="M"> Male
                  </label>
                <label for="" class="radio">
                      <input type="radio" v-model="form.profile.gender" name="gender" value="F"> Female
                  </label>
              </div>
            </div>
          </div>
        </div>

        <div class="columns control">
          <div class="column">
            <label class="title is-6"> Phone </label>
            <div class="field has-addons is-12">
              <p class="control">
                <span class="select">
                    <select class="input">
                      <option> +91 </option>
                      <option> +079 </option>
                    </select>
                  </span>
              </p>
              <!-- <label for=""> Phone No. </label> -->
              <span class="control">
                  <input type="text" class="input" v-model="form.profile.phoneno" placeholder="Phone No." name="" value="">
                </span>
            </div>
          </div>

          <div class="column">
            <div class="field">
              <label for="" class="title is-6">Email</label>
              <div class="control">
                <input type="email" placeholder="eg. abc@example.com" v-model="form.profile.email" class="input" name="" value="">
              </div>
            </div>
          </div>
        </div>

        <div class="columns control">
          <div class="column">
            <address-component title="Permanent Address" primary-address="true" v-on:show-detail="getAddress($event, 'permanent')">
            </address-component>
          </div>

          <div class="column">
            <address-component title="Present Address" primary-address-title="Permanent" v-on:copy-address="getPermanentAddress" v-on:show-detail="getAddress($event, 'present')">
            </address-component>
          </div>
        </div>

        <div class="columns control">
          <div class="column">
            <div class="field">
              <div class="control">
                <a @click="saveProfile" class="button is-primary">
                      <span class="icon">
                        <i class="fa fa-check"></i>
                      </span>
                      <span>Save</span>
                    </a>
              </div>
            </div>
          </div>
          <div class="column">
            <div class="field is-pulled-right">
              <div class="control">
                <button @click="skipProfile" class="button is-primary is-outlined" type="button" name="button">
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
import Vue from 'vue';
import VCalendar from 'v-calendar';
import 'v-calendar/lib/v-calendar.min.css';
Vue.use(VCalendar);

export default {
  props: ['title'],
  data: function() {
    return {
      themeStyles: {
        header: {
          color: '#fafafa',
          backgroundColor: 'rgba(227, 74, 26, 0.88)',
          borderColor: '#404c59',
          borderWidth: '1px 1px 0 1px',
        }
      },
      form: {
        profile: {
          title: 'Mr',
          first_name: '',
          middle_name: '',
          last_name: '',
          nick_name: '',
          dob: '',
          picture: '',
          gender: '',
          phoneno: '',
          email: '',
        },
        relations: {
          permanentAddress: {},
          residenceAddress: {}
        },
        commonAddress: false
      }
    }
  },
  created: function() {
    // axios.post("http://192.168.1.65/IndiaGuideService/index.php/getStates",{})
    // .then(response => {
    //   console.log(response.data);
    // })
    // .catch(error => {
    //   console.log(error);
    // })
  },
  methods: {
    getTitle: function() {
      console.log(this.form.profile.title);
    },
    showAddress: function() {
      this.show = !(this.show);
    },
    getAddress: function(address, addressTitle) {
      if (addressTitle == 'permanent') {
        this.form.relations.permanentAddress = address;
      } else if (addressTitle == 'present') {
        this.form.relations.residenceAddress = address;
      }
    },
    getPermanentAddress: function(flag) {
      console.log("FLAG -> " + flag);
      this.form.commonAddress = flag;
    },
    skipProfile: function() {
      console.log(this.$store.getters.intendedPath);
      let path = this.$store.getters.intendedPath;
      this.$router.push(path);
      // this.$router.go('-1');
    },
    saveProfile: function() {
      axios.post('/api/profile/personal', this.form)
        .then(response => {
          console.log(response.data);
        })
        .catch(error => {
          console.log(error);
        })
    }
  },
  mounted: function() {
    console.log("MOUNTED");
    axios.get('/api/profile/personal')
      .then(response => {
        console.log("RESPONSE");
        console.log(response.data);
      })
      .catch(error => {
        console.log(error);
      })
  },
  components: {
    'address-component': AddressComponent
  }

}
</script>

<style media="screen" lang="scss">
  .columns{
    &.control{
      padding: 0.5rem 0;
    }
  }
  .control{
    .column {
      padding: .3rem;
    }
  }
</style>
