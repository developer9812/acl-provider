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
              <div v-if="!this.primaryAddress" class="control columns">
                <!-- <label for=""> </label> -->
                <button class="button is-primary is-outlined" @click="copyAddress" type="button" name="button"> Same As {{ this.primaryAddressName }} </button>
              </div>

              <div class="control columns">
                <div class="column is-4">
                  <input type="text" class="input" placeholder="Block No" @change="changeAddress" v-model="address.block_no" name="" value="">
                </div>
                <div class="column is-8">
                  <input type="text" class="input" placeholder="Building" @change="changeAddress" v-model="address.building" name="" value="">
                </div>
              </div>

              <div class="control columns">
                <div class="column">
                  <input type="text" class="input" placeholder="Street" @change="changeAddress" v-model="address.street" name="" value="">
                </div>
                <div class="column">
                  <input type="text" class="input" placeholder="Landmark" @change="changeAddress" v-model="address.landmark" name="" value="">
                </div>
              </div>

              <div class="control columns">
                <div class="column">
                  <input type="text" class="input" placeholder="City" @change="changeAddress" v-model="address.city" name="" value="Ahmedabad">
                </div>
                <div class="column">
                  <input type="text" class="input" placeholder="Pincode" @change="changeAddress" v-model="address.pincode" name="" value="">
                </div>
              </div>
              <div class="control columns">

                <div class="column">
                  <div class="control">
                    <input type="text" class="input" style="background-color:lightgrey" v-model="address.country" disabled="disabled" placeholder="country" name="" value="India">
                  </div>
                </div>
                <div class="column">
                  <div class="field">
                    <div class="control">
                      <div class="select">
                        <select v-model="address.state" class="input is-primary" name="">
                          <option v-for="state in states" :value="state"> {{ state }}</option>
                        </select>
                      </div>

                    </div>
                  </div>
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
export default {
  props: ['title','primaryAddress','primaryAddressTitle'],
  // props: {
  //   title: {
  //     type: String
  //   },
  //   primary: {
  //     type: Boolean
  //   },
  //   primaryAddressTitle: {
  //     type: String
  //   }
  // },
  data: function(){
    return {
      address: {
        block_no: '',
        building: '',
        street: '',
        landmark: '',
        pincode: '',
        city: '',
        district: 'Ahmedabad',
        district_iso: 'AH',
        state: 'Gujarat',
        state_iso: 'GJ',
        country: 'India'
      },
      states: ["Gujarat","Maharashtra","Rajsthan","MP","UP"],
      show: false
    }
  },
  computed: {
    primaryAddressName: function(){
      if (this.primaryAddressTitle && (this.primaryAddressTitle.length > 0)) {
        return this.primaryAddressTitle;
      } else {
        return "Primary";
      }
    }
  },
  methods: {
    showAddress: function(){
      this.show = !(this.show);
    },
    changeAddress: function(){
      this.$emit('show-detail', this.address);
    },
    copyAddress: function(){
      this.show = !(this.show);
      this.$emit('copy-address', true);
    },
    addressBlock: function(){
      console.log("CHANGE");
      this.$emit('show-detail', this.address);
    }
  }
}
</script>

<style lang="scss" scoped>
  .control{
    .column{
      padding: 0.3rem;
      .select{
        width: 100%;
      }
    }
  }
</style>
