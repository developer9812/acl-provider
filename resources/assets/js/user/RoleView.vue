<template lang="html">
  <div class="modal" :class="{'is-active': viewRole}">
    <div class="modal-background" @click="closeView"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Role: {{ role.name }}</p>
        <button class="delete" aria-label="close" @click="closeView"></button>
      </header>
      <section class="modal-card-body">
        <nav class="level">
          <div class="level-left">
            <div class="level-item">
              <p class="subtitle is-5">
                <strong>Permisions</strong>
              </p>
            </div>
            <div class="level-item">
              <div class="field has-addons">
                <p class="control">
                  <input class="input" type="text" placeholder="Find a permission">
                </p>
                <p class="control">
                  <button class="button">
                    Search
                  </button>
                </p>
              </div>
            </div>
          </div>

          <div class="navbar-end">
           <div class="navbar-item has-dropdown" :class="{ 'is-active' : moreView }">
             <a class="navbar-link" @click="moreView = !moreView">
               More
             </a>
             <div class="navbar-dropdown is-right">
               <a class="navbar-item" @click="createDuplicate">
                 Duplicate Role
               </a>
               <a class="navbar-item" @click="deleteRole">
                 Delete Role
               </a>
             </div>
           </div>
         </div>
        </nav>
        <table class="table is-fullwidth">
          <thead>
            <tr>
              <th>Permission ID</th>
              <th>Permission Name</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="permission in permissions">
              <td>{{ permission.id }}</td>
              <td>{{ permission.name }}</td>
              <td>
                <label class="checkbox">
                  <!-- <input type="checkbox" @change="updatePermission" :checked="hasPermission(permission.id)"> -->
                  <input type="checkbox" v-model="rolePermissionMap[permission.id]">
                  {{ rolePermissionMap[permission.id] ? "Allowed" : "Not Allowed" }}
                </label>
              </td>
            </tr>
          </tbody>
        </table>
      </section>
      <footer class="modal-card-foot">
        <button class="button is-success" @click="updatePermissions">Save changes</button>
        <button class="button" @click="closeView">Cancel</button>
      </footer>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    role: {
      type: Object,
      default: null
    },
    show: {
      type: Boolean,
      default: false
    }
  },
  data: function(){
    return {
      viewRole: this.show,
      permissions: [],
      rolePermissions: [],
      rolePermissionMap: {},
      moreView: false
    }
  },
  created: function(){
    this.getPermissions();
  },
  methods: {
    getPermissions: function(){
      axios.get('/user/roles/permission', {
        params: {
          role: this.role.id
        }
      }).then(response => {
        console.log('RESPONSE');
        console.log(response.data);
        this.rolePermissions = response.data.role_permissions;
        this.permissions = response.data.permissions;
        _.forEach(this.permissions, (permission) => {
          if (_.some(this.rolePermissions, ['id', permission.id])) {
            Vue.set(this.rolePermissionMap, permission.id, true);
          } else {
            Vue.set(this.rolePermissionMap, permission.id, false);
          }
        });
      }).catch(error => {
        console.log("ERROR");
        console.log(error);
      })
    },
    hasPermission: function(permission){
      return _.some(this.rolePermissions, ['id', permission]);
    },
    updatePermissions: function(){
      console.log("UPDATE PERMISSION");
      let newPermissions  = _.filter(this.permissions, permission => {
        return this.rolePermissionMap[permission.id];
      });
      console.log(newPermissions);
      axios.post('/user/roles/permission/update', {
        role: this.role.id,
        permissions: newPermissions
      }).then(response => {
        console.log(response);
      }).catch(error => {
        console.log(error);
      });
    },
    createDuplicate: function(){

    },
    deleteRole: function(){
      axios.delete('/user/role/' + this.role.id)
        .then(response => {
          console.log(response);
          if (response.data) {
            this.viewRole = false;
            this.$emit('close-role-view');
          }
        })
        .catch(error => {
          console.log(error);
        })
    },
    closeView: function(){
      this.viewRole = false;
      this.$emit('close-role-view');
    }
  },
  watch: {
    'show': function(){
      this.viewRole = this.show;
    }
  }
}
</script>

<style lang="scss">
</style>
