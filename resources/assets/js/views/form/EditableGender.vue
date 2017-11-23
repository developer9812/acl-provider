<template lang="html">
  <div class="columns">
    <div class="columns" v-show="edit">
      <div class="column">
        <div class="control" >
          <input v-model="user.gender" type="radio" name="gender" value="M"> Male
          <input type="radio" v-model="user.gender" name="gender" value="F"> Female
        </div>
      </div>
      <div class="column">
        <span v-show="edit" @click="saveChange"><i class="fa fa-check"></i></span>
      </div>
    </div>
    <div class="columns">
      <div class="column">
        <span v-show="!edit"> {{ user.gender }} </span><span class="cursor-pointer" @click="edit = true" v-show="!edit"><i class="fa fa-pencil"></i></span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['gender'],
  data: function(){
    return {
      edit: false,
      user: {
          gender: this.gender
      }
    }
  },
  created: function(){
    console.log("GENDER CREATED");
    console.log(this.gender);
  },
  methods: {
    saveChange(){
      console.log("SAVE CHANGE");
      this.edit = false;
      // let user_gender =
      // this.user.gender = gender;
      console.log(this.user.gender);
      this.$emit('save-change', this.user.gender);
    },
    changeGender(){
      console.log("adasd");
      if(this.user.gender == "M"){
        this.user.gender = "male"
      }else if(this.user.gender == "F"){
        this.user.gender = "female"
      }else{}
    }
  },
  watch: {
    gender: function(){
      console.log("WATCH");
      console.log(this.gender);
      this.user.gender = this.gender;
    }
  }
}
</script>

<style lang="css">
</style>
