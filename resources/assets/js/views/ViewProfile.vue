<template lang="html">
  <div class="container">
    <div class="section">
      <div class="columns is-centered">
        <div class="column is-8">
          <div class="columns is-centered">
            <div class="column is-paddingless">
              <h3 class="title is-4"> Personal Profile </h3>
              <article class="media">
                <figure class="media-left" style="width: 140px;">
                  <p class="image">
                    <img src="../../images/user.png" style="border-radius: 50%" alt="Placeholder image">
                  </p>
                  <h4 class="title is-6" style="padding: 10px;">
                    <span> Change Photo </span>
                    <span class="cursor-pointer">
                      <i class="fa fa-pencil"></i>
                    </span>
                  </h4>
                </figure>

                <div class="media-content">
                  <div class="content">
                     <p><strong class="title is-2"> {{ user.first_name }} {{ user.middle_name }} {{ user.last_name }} </strong></p>
                     <p><small> {{ user.email }} </small> <small> </small></p>
                  </div>
                </div>
              </article>
            </div>
          </div>
          <div class="columns" style="margin: 40px;">
            <div class="column">
              <div class="content">
                <div class="columns">
                  <div class="column is-narrow is-paddingless title is-6">
                    Name
                  </div>
                  <div class="column is-paddingless">
                    <edit-input :name="this.name" @save-change="saveChanges('name', $event)"></edit-input>
                  </div>
                </div>
                <div class="columns">
                  <div class="column is-paddingless title is-6">
                    Address
                  </div>
                  <div class="column is-paddingless">
                    <textarea class="textarea" v-show="editaddress" ref="editaddress" @blur="editaddress = false" v-model="user.permanent_address"></textarea>
                    <span v-show="!editaddress"> {{ user.permanent_address }}</span><span class="cursor-pointer" @click="editProfile('permanent_address', user.permanent_address)"><i class="fa fa-pencil"></i></span>
                  </div>
                </div>

                <div class="columns">
                  <div class="column is-paddingless title is-6">
                    Email
                  </div>
                  <div class="column is-paddingless">
                    <editable-email :email="user.email" @save-change="saveChanges('email', $event)"></editable-email>
                    <!-- <input type="email" v-show="editemail" ref="editemail" class="input" @blur="editemail = false" v-model="user.email">
                    <span v-show="!editemail"> {{ user.email }} </span><span class="cursor-pointer" @click="editProfile('email', user.email)"><i class="fa fa-pencil"></i></span> -->
                  </div>
                </div>

                <div class="columns">
                  <div class="column is-paddingless title is-6">
                    Date Of Birth
                  </div>
                  <div class="column is-paddingless">
                    <editable-date :dob="user.dob" @save-change="saveChanges('dob', $event)"></editable-date>
                    <!-- <div class="control" v-show="editdob">
                      <v-date-picker mode='single' inputClass='input' v-model='user.dob'></v-date-picker>
                    </div>
                    <span v-show="!editdob"> {{ user.dob }} </span><span class="cursor-pointer" @click="editProfile('dob', user.dob)"><i class="fa fa-pencil"></i></span> -->
                  </div>
                </div>

                <!-- <div class="columns">
                  <div class="column is-paddingless  title is-6 ">
                    Phone
                  </div>
                  <div class="column is-paddingless ">
                    <span> {{ user.phone }} </span><span class="cursor-pointer"><i class="fa fa-pencil"></i></span>
                  </div>
                </div> -->

                <div class="columns">
                  <div class="column  is-paddingless title is-6">
                    Gender
                  </div>
                  <div class="column  is-paddingless">
                    <editable-gender :gender="user.gender" @save-change="saveChanges('gender', $event)"></editable-gender>
                    <!-- <div class="control" v-show="editgender">
                      <label for="" class="radio">
                        <input class="radio radio-primary" v-model="user.gender" @change="changeGender('male')" type="radio" name="gender" value="M"> Male
                      </label>
                      <label for="" class="radio">
                          <input class="radio radio-primary" type="radio" v-model="user.gender" @change="changeGender('female')" name="gender" value="F"> Female
                      </label>
                    </div>
                    <span v-show="!editgender"> {{ user.gender }} </span><span class="cursor-pointer" @click="editProfile('gender', user.gender)"><i class="fa fa-pencil"></i></span> -->
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
import EditableName from './form/EditableName.vue';
import EditableEmail from './form/EditableEmail.vue';
import EditableDate from './form/EditableDate.vue';
import EditableGender from './form/EditableGender.vue';

export default {
  data: function() {
    return {
      user: {
        nick_name: '',
        permanent_address: null,
        residence_address: null,
        dob: '',
        phone: '',
        email: '',
        gender: ''
      },
      editname: false,
      editaddress: false,
      editemail: false,
      editgender: false,
      editdob: false
    }
  },
  computed: {
    name: function(){
      return {
        title: this.user.title,
        first_name: this.user.first_name,
        middle_name: this.user.middle_name,
        last_name: this.user.last_name
      }
      // return this.user.title+' '+this.user.first_name+' '+this.user.middle_name+' '+this.user.last_name
    }
  },
  created: function(){
    axios.get('api/profile/personal')
    .then(response => {
      console.log(response.data);
      this.user = response.data;
      // this.user.name = response.data.first_name+ " "+response.data.middle_name+" "+response.data.last_name;
      this.user.permanent_address = response.data.permanent_address.block_no+", "+response.data.permanent_address.building+" "+response.data.permanent_address.street+" "+response.data.permanent_address.landmark+" "+response.data.permanent_address.city+" - "+response.data.permanent_address.pincode;
      this.user.email = response.data.user.email;
      if(response.data.gender == "M"){
        this.user.gender = "male";
      }else if(response.data.gender == "F"){
        this.user.gender = "female";
      }else{}
      console.log(this.user);
    })
    .catch(error => {
      console.log(error);
    });
  },
  methods: {
    editProfile: function(userfield, userValue){
      if(userfield == "name"){
        this.editname = true;
      }else if(userfield == "permanent_address"){
        this.editaddress = true;
      }else if(userfield == "email"){
        this.editemail = true;
      }else if(userfield == "gender"){
        this.editgender = true;
      }else if(userfield == "dob"){
        this.editdob = true;
      }
      this.user[userfield] = userValue;
    },
    saveChanges: function(attribute, payload){
      console.log("SAVE ..");
      console.log(payload);
      axios.put('api/profile/personal/'+this.user.id+'/'+attribute,{
        value: payload
      })
      .then(response => {
        console.log("PROFILE RESPONSE");
        console.log(response);
      })
      .catch(error => {
        console.log("PROFILE ERROR");
        console.log(error);
      });
    },
    changeGender: function(gender){
      this.user.gender = gender;
      this.editgender = false;
    },
    updateProfile: function(){
      console.log(this.user.id);
        // axios.post('/api/profile/personal/'+)
    },
    updateName: function(name){
      this.editname = false;
      console.log(name);
    }
  },
  components: {
    'edit-input': EditableName,
    'editable-email': EditableEmail,
    'editable-date': EditableDate,
    'editable-gender': EditableGender
  },
  watch: {
    // editname: function(){
    //   if(this.editname){
    //     Vue.nextTick(() =>{
    //       this.$refs.editable.focus();
    //     });
    //   }
    // },
    editaddress: function(){
      if(this.editaddress){
        Vue.nextTick(() =>{
          this.$refs.editaddress.focus();
        });
      }
    },
    editemail: function(){
      if(this.editemail){
        Vue.nextTick(() =>{
          this.$refs.editemail.focus();
        });
      }
    }
  }
}
</script>
<style lang="css">
  .mainpage{
    border: 2px solid red;
  }
  .cursor-pointer{
    cursor: pointer;
  }
</style>
