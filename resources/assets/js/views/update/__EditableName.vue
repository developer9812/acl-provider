<template lang="html">
  <div class="">
    <div class="columns" v-show="editinput">
      <div class="column">
        <input ref="editable" class="input" v-model="form.title" @blur="editinput = false"></input>
      </div>
      <div class="column">
        <input class="input" v-model="form.first_name" @blur="editinput = false"></input>
      </div>
      <div class="column">
        <input class="input" v-model="form.middle_name" @blur="editinput = false"></input>
      </div>
      <div class="column">
        <input class="input" v-model="form.last_name" @blur="editinput = false"></input>
      </div>
    </div>
    <span v-show="!editinput"> {{ this.form }} </span><span class="cursor-pointer"><i class="fa fa-pencil"></i></span>
  </div>
</template>

<script>
export default {
  props: ['name'],
  data: function(){
    return{
      editinput: false,
      form: this.name,
    }
  },
  methods: {
    editProfile(userfield, uservalue){
      this.editinput = true;
      this.user.name = uservalue;
    },
    saveChanges(){
      this.$emit('save-change', this.form);
    }
  },
  watch: {
    editinput: function(){
      Vue.nextTick(() => {
        this.$refs.editable.focus();
      });
    }
  }
}
</script>

<style lang="css">
</style>
