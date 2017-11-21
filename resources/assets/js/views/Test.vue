admi<template lang="html">
  <div class="">
    <a @click="callApi" class="button is-primary is-outlined">Test API</a>
    <a @click="udpateApi" class="button is-primary is-outlined">Test UPDATE API</a>
    <a @click="updateAddress" class="button is-primary is-outlined">Test ADDRESS UPDATE API</a>
    <div class="column">
      <p class="field">
        <input type="text" name="" ref="editable" value="" v-model="editText">
      </p>
      <p class="field">
        <a class="button" @click="setFocus">Set Focus</a>
        <a class="button" @click="editText = 'New Text'">Change Text</a>
      </p>
    </div>
  </div>
</template>

<script>
export default {
  data: function(){
    return {
      editText: 'Demo',
      form: {
      	"profile": {
      	  "title": "Mr",
      	  "first_name": "John",
      	  "middle_name": "",
      	  "last_name": "Smith",
      	  "nick_name": "",
      	  "dob": "11/11/1990",
      	  "picture": "",
      	  "gender": "M",
      	},
      	"relations": {
      		"permanentAddress": {
            "block": "12",
            "building": "ABC",
            "street": "S1",
            "landmark": "Nr S2",
            "pincode": "122456",
            "city": "Ahmedabad",
            "district": 'Ahmedabad',
            "district_iso": 'AH',
            "state": "Gujarat",
            "state_iso": 'GJ',
            "country": "India"
      		},
      		"residenceAddress": {
            "block": "12",
            "building": "ABC",
            "street": "S1",
            "landmark": "Nr S2",
            "pincode": "122456",
            "city": "Ahmedabad",
            "district": 'Ahmedabad',
            "district_iso": 'AH',
            "state": "Gujarat",
            "state_iso": 'GJ',
            "country": "India"
      		}
      	}
      }
    }
  },
  mounted: function(){
    // this.$refs.editable.focus();
  },
  methods: {
    setFocus: function(){
      this.$refs.editable.focus();
    },
    callApi: function(){
      axios.post('/api/profile/personal', this.form)
      .then(response => {
        console.log("Response");
        console.log(response);
      })
      .catch(error => {
        console.log("ERROR");
        console.log(error);
      })
    },
    udpateApi: function(){
      axios.put('/api/profile/personal/' + '1' + '/' + 'first_name', {
        value : "Mark"
      }).then(response => {
        console.log('RESPONSE');
        console.log(response);
      }).catch(error => {
        console.log("ERROR");
        console.log(error);
      })
    },
    updateAddress: function(){
      let address = {
        "block": "122",
        "building": "LMN",
        "street": "S1",
        "landmark": "Nr S2",
        "pincode": "122456",
        "city": "Ahmedabad",
        "district": 'Ahmedabad',
        "district_iso": 'AH',
        "state": "Gujarat",
        "state_iso": 'GJ',
        "country": "India"
      }
      axios.put('/api/profile/personal/' + '1' + '/' + 'permanentAddress', {
        value: address
      }).then(response => {
        console.log("RESPONSE");
        console.log(response);
      }).catch(error => {
        console.log("ERROR");
        console.log(error);
      })
    }
  },
  watch: {
    'editText': function(){
      this.$refs.editable.focus();
    }
  }
}
</script>

<style lang="css">
</style>
