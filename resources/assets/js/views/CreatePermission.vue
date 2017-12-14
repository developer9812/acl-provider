<template lang="html">
  <div class="modal is-active">
    <div class="modal-background" @click="closeView"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">New Permission</p>
        <button class="delete" aria-label="close" @click="closeView"></button>
      </header>
      <section class="modal-card-body">
        <div class="field">
          <label class="label">Permission Name</label>
          <div class="control">
            <input class="input" type="text" placeholder="eg: view-profile" v-model="permissionName">
          </div>
          <p class="help is-danger" v-if="error">{{message}}</p>
        </div>
      </section>
      <footer class="modal-card-foot">
        <button class="button is-success" @click="submit">Save changes</button>
        <button class="button" @click="closeView">Cancel</button>
      </footer>
    </div>
  </div>
</template>

<script>
import vSelect from 'vue-select';

export default {
  props: {
  },
  data: function(){
    return {
      permissionName: '',
      error: false,
      message: ''
    }
  },
  mounted: function(){
    // this.getUserRoles();
  },
  methods: {
    submit: function(){
        this.savePermission();
    },
    savePermission: function(){
      axios.post('/api/master/permission', {
        permission: this.permissionName
      }).then(response => {
        this.closeView();
      }).catch(error => {
        console.log("PERMISSION ERROR");
        this.error = true;
        this.message = error.response.data.message;
        setTimeout(() => {
          this.error = false;
          this.message = "";
        }, 5000);
      })
    },
    updatePermission: function(){
      axios.put('/api/master/permission' + this.permission.id, {
        permission: this.permissionName
      }).then(response => {
        this.closeView();
      }).catch(error => {
        console.log("PERMISSION ERROR");
        this.error = true;
        this.message = error.response.data.message;
        setTimeout(() => {
          this.error = false;
          this.message = "";
        }, 5000);
      })
    },
    closeView: function(){
      this.$emit('close-view');
    }
  },
  components: {
  },
  watch: {
    'permissionName': function(){
      this.error = false;
    }
  }
}
</script>
