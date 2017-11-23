<template lang="html">
  <div class="columns">
    <div class="columns" v-show="edit">
      <div class="column">
        <input ref="editable" class="input" v-model="form.title" ></input>
      </div>
      <div class="column">
        <input class="input" v-model="form.first_name"></input>
      </div>
      <div class="column">
        <input class="input" v-model="form.middle_name"></input>
      </div>
      <div class="column">
        <input class="input" v-model="form.last_name"></input>
      </div>
      <div class="column">
        <span v-show="edit" @click="saveChange"><i class="fa fa-check"></i></span>
      </div>
    </div>
    <div class="columns">
      <div class="column">
        <span v-show="!edit"> {{ form.title + " " + form.first_name + " " + form.middle_name + " " + form.last_name}} </span><span class="cursor-pointer" @click="edit = true" v-show="!edit"><i class="fa fa-pencil"></i></span>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  props: ['name'],
  data: function(){
    return{
      edit: false,
      form: this.name,
    }
  },
  watch: {
    name: function(){
      this.form = this.name;
    }
  },
  methods: {
    editProfile(userfield, uservalue){
      this.editinput = true;
      this.user.name = uservalue;
    },
    saveChange(){
      this.edit = false;
      this.$emit('save-change', this.form);
    }
  }
}
</script>

<style lang="css">
</style>
