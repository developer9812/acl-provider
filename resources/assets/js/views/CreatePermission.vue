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
          <p class="help is-danger" v-if="error">Enter a valid name</p>
        </div>
      </section>
      <footer class="modal-card-foot">
        <button class="button is-success" @click="savePermission">Save changes</button>
        <button class="button" @click="closeView">Cancel</button>
      </footer>
    </div>
  </div>
</template>

<script>
import vSelect from 'vue-select';

export default {
  data: function(){
    return {
      permissionName: '',
      error: false,
    }
  },
  created: function(){
    this.getUserRoles();
  },
  methods: {
    savePermission: function(){
      axios.post('api/master/permission', {
        permission: this.permissionName
      }).then(response => {
        this.closeView();
      }).catch(error => {
        this.error = true;
      })
    },
    closeView: function(){
      this.$emit('close-view');
    }
  },
  components: {
  },
  watch: {
  }
}
</script>
