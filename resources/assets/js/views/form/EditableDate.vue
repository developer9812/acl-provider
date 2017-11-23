<template lang="html">
  <div class="columns">
    <div class="columns" v-show="edit">
      <div class="column">
        <div class="control" >
          <v-date-picker mode='single' inputClass='input' v-model='dateofbirth'></v-date-picker>
        </div>
        <div class="column">
          <span v-show="edit" @click="saveChange"><i class="fa fa-check"></i></span>
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="column">
        <span v-show="!edit"> {{ dateofbirth }} </span><span class="cursor-pointer" @click="saveChange" v-show="!edit"><i class="fa fa-pencil"></i></span>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  props: ['dob'],
  data: function(){
    return{
      edit : false,
      dateofbirth: this.dob
    }
  },
  created: function(){
    console.log("CREATED");
    console.log(typeof(this.dob));
  },
  methods:{
    saveChange(){
      this.edit = true;
      this.$emit('save-change', this.dateofbirth);
    }
  },
  watch:{
    dob: function(){
      this.dateofbirth = this.dob;
    }
  }
}
</script>

<style lang="css">
</style>
