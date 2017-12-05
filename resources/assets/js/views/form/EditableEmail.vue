<template lang="html">
  <div class="columns">
    <div class="columns" v-show="edit">
      <div class="column">
        <input class="input" type="text" v-model="emailid"></input>
      </div>
      <div class="column">
        <span v-show="edit" @click="saveChange"><i class="fa fa-check"></i></span>
      </div>
    </div>
    <div class="columns">
      <div class="column">
        <span v-show="!edit"> {{ emailid }} </span><span class="cursor-pointer" @click="edit = true" v-show="!edit"><i class="fa fa-pencil"></i></span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['email'],
  data: function(){
    return {
      edit: false,
      emailid: this.email
    }
  },
  created: function(){
    console.log(this.email);
  },
  methods: {
    saveChange(){
      this.edit = false;
      this.$emit('save-change', this.emailid);
    }
  },
  watch: {
    email: function(){
      console.log("EMAIL WATCH");
      this.emailid = this.email;
    }
  }
}
</script>

<style lang="css">
</style>
