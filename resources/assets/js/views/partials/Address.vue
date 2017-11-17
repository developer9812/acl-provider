<template lang="html">
  <div class="field">
    <div class="control">
      <div class="card is-primary">
        <header class="card-header" @click="showAddress">
          <p class="card-header-title">
            {{ title }}
          </p>
          <a href="#" class="card-header-icon">
            <span class="icon">
              <i v-show="show" class="fa fa-angle-down"></i>
              <i v-show="!show" class="fa fa-angle-right"></i>
            </span>
          </a>
        </header>
        <div class="" v-show="show">
          <div class="card-content">
            <div class="content">
              <div v-if="title === 'Present Address'" class="control columns">
                <button class="button" @click="copyAddress" type="button is-primary is-outlined" name="button"> Same As Permanent </button>
              </div>

              <div class="control columns">
                <div class="column is-2">
                  <input type="text" class="input" placeholder="block" @change="changeAddress" v-model="address.block" name="" value="">
                </div>
                <div class="column is-5">
                  <input type="text" class="input" placeholder="building" @change="changeAddress" v-model="address.building" name="" value="">
                </div>
                <div class="column is-5">
                  <input type="text" class="input" placeholder="street" @change="changeAddress" v-model="address.street" name="" value="">
                </div>
              </div>

              <div class="control columns">
                <div class="column is-4">
                  <input type="text" class="input" placeholder="landmark" @change="changeAddress" v-model="address.landmark" name="" value="">
                </div>
                <div class="column is-4">
                  <input type="text" class="input" placeholder="pincode" @change="changeAddress" v-model="address.pincode" name="" value="">
                </div>
              </div>

              <div class="control columns">
                <div class="column is-4">
                  <div class="control">
                    <input type="text" class="input" style="background-color:lightgrey" v-model="address.country" disabled="disabled" placeholder="country" name="" value="India">
                  </div>
                  <!-- <input type="text" class="input" style="background-color:lightgrey" disabled="disabled" placeholder="country" name="" value="India"> -->
                </div>
                <div class="column is-4">
                  <div class="field">
                    <div class="control">
                      <div class="select">
                        <select v-model="address.state" class="input is-primary" name="">
                          <option v-for="state in states" :value="state"> {{ state }}</option>
                        </select>
                      </div>

                    </div>
                  </div>
                  <!-- <input type="text" class="input" style="background-color:lightgrey" disabled="disabled" placeholder="state" value="Gujarat" name=""> -->
                </div>
                <div class="column is-4">
                  <input type="text" class="input" placeholder="city" @change="changeAddress" v-model="address.city" name="" value="Ahmedabad">
                </div>
              </div>
            </div>
          </div>
          <!-- <footer class="card-footer">
            <a href="#" class="card-footer-item">Save</a>
            <a href="#" class="card-footer-item">Edit</a>
            <a href="#" class="card-footer-item">Delete</a>
          </footer> -->
        </div>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['title'],
  data: function(){
    return {
      address: {
        block: '',
        building: '',
        street: '',
        landmark: '',
        pincode: '',
        state: 'Gujarat',
        city: ''
      },
      states: ["Gujarat","Maharashtra","Rajsthan","MP","UP"],
      show: false
    }
  },
  methods: {
    showAddress: function(){
      this.show = !(this.show);
    },
    changeAddress: function(){
      console.log(this.title);
      this.$emit('show-detail', this.address, this.title);
    },
    copyAddress: function(){

    },
    addressBlock: function(){
      console.log("CHANGE");
      this.$emit('show-detail', this.address);
    }
  }
}
</script>

<style lang="css">
</style>
