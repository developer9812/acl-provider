<template lang="html">
  <div class="container">
    <div class="section">
      <h5 class="title is-5">Permission Management</h5>
      <div class="level">
        <div class="level-left">
          <div class="level-item">
            <div class="field has-addons">
              <p class="control">
                <input class="input" type="text" placeholder="Find a permission">
              </p>
              <p class="control">
                <button class="button is-primary">
                  Search
                </button>
              </p>
            </div>
          </div>
        </div>
        <div class="level-right">
          <div class="level-item">
            <a href="#" class="button is-primary" @click="createPermission">Add New</a>
          </div>
        </div>
      </div>
    </div>
    <div class="section" style="padding-top: 0">
      <div class="columns is-multiline">
        <div class="column is-4" v-for="permission in permissions">
          <div class="box">
            <div class="columns">
              <div class="column">
                <h3 class="title is-5">{{ permission.name }}</h3>
                <p class="subtitle is-6">{{ permission.guard_name }}</p>
              </div>
              <div class="column is-narrow">
                <a href="#" class="button is-info is-small  is-outlined" @click="editPermission(permission)">
                  <span class="icon"><i class="fa fa-edit"></i></span>
                  <span>Edit</span>
                </a>
                <a href="#" class="button is-danger is-small is-outlined" @click="deletePermission(permission.id)">
                  <span class="icon"><i class="fa fa-trash-o"></i></span>
                  <span>Delete</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <create-permission-view
      v-if="createNew"
      new="newPermission",
      permission="selectedPermission"
      @close-view="closeCreateView">
    </create-permission-view>
  </div>
</template>

<script>
import CreatePermission from './CreatePermission.vue';

export default {
  data: function(){
    return {
      permissions: {},
      createNew: false,
      selectedPermission: null,
      newPermission: true
    }
  },
  created: function(){
    this.getPermissions();
  },
  methods: {
    deletePermission: function(id){
      axios.delete('/api/master/permission/'+id)
      .then(response => {
        console.log(response.data);
        if (response.data.status) {
          this.getPermissions();
        } else {
          alert("Unable to delete");
        }
      })
      .catch(error => {
        console.log(error);
      })
    },
    editPermission: function(permission){
      this.selectedPermission = permission;
      this.newPermission = false;
      this.createNew = true;
    },
    getPermissions: function(){
      axios.get('/api/master/permissions')
      .then(response => {
        console.log(response.data);
        this.permissions = response.data;
      })
      .catch(error => {
        console.log(error);
      })
    },
    createPermission: function(){
      this.createNew = true;
    },
    closeCreateView: function(){
      this.createNew = false;
      this.getPermissions();
    }
  },
  components: {
    'create-permission-view': CreatePermission
  }
}
</script>

<style lang="css">
</style>
