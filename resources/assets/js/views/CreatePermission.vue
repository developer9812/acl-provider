<template lang="html">
  <div class="modal is-active">
    <div class="modal-background" @click="closeView"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title" v-if="new">New Permission</p>
        <p class="modal-card-title" v-else>Edit Permission</p>
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
    new: {
      type: Boolean,
      default: true
    },
    permission: {
      type: Object,
      default: null
    }
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
    if (!this.new) {
      this.permissionName = this.permission.name;
    }
  },
  methods: {
    submit: function(){
      if (this.new) {
        this.savePermission();
      } else {
        this.updatePermission();
      }
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
