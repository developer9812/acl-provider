<template lang="html">
  <div class="column is-paddingless">
    <section class="section">
      <nav class="level">
        <div class="level-left">
          <div class="level-item">
            <div class="field has-addons">
              <p class="control">
                <input class="input" type="text" v-model="roleSearch" placeholder="Find a role">
              </p>
              <p class="control">
                <button class="button" @click="filterRoles">
                  Search
                </button>
              </p>
            </div>
          </div>
        </div>
        <div class="level-right">
          <div class="level-item">
            <a class="button is-primary is-outlined" @click="addNewRole">New Role</a>
          </div>
        </div>
      </nav>
      <table class="table is-fullwidth">
        <thead>
          <tr>
            <th>Role ID</th>
            <th>Role Name</th>
            <th>Parent Role</th>
            <th>Created By</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for='role in filteredRoles'>
            <td>{{ role.id }}</td>
            <td>{{ role.name }}</td>
            <td>{{ role.parent ? role.parent.name : 'N/A' }}</td>
            <td>{{ role.owner ? role.owner.name : 'N/A' }}</td>
            <td><a class="button is-small" @click="selectedRole = role">View</a></td>
          </tr>
        </tbody>
      </table>
    </section>

    <role-view :role="selectedRole" :show="selectedRole != null" v-if="selectedRole != null" @close-role-view="closeRoleView"></role-view>

    <create-role v-if="newRole" :roles="roles" @close-view="closeCreateRole"></create-role>

    <!-- <div class="modal" :class="{'is-active': newRole}">
      <div class="modal-background" @click="newRole = false"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">New Role</p>
          <button class="delete" aria-label="close" @click="newRole = false"></button>
        </header>
        <section class="modal-card-body">
          <div class="field">
            <label class="label">Role Name</label>
            <div class="control">
              <input class="input" type="text" placeholder="eg: admin" v-model="roleName">
            </div>
            <p class="help is-danger" v-if="error">Enter a valid name</p>
          </div>
          <hr>
          <div class="field">
            <label class="label">Define a Parent Role</label>
          </div>
          <div class="columns">
            <div class="column">
              <div class="field">
                <label class="label"><a class="button is-link">From own roles</a></label>
                <div class="control">
                  <v-select
                    v-model="newRoleParent"
                    label="name"
                    placeholder="Select a Role"
                    maxHeight='4rem'
                    :options="roles">
                  </v-select>
                </div>
              </div>
            </div>
            <div class="column is-2">
              OR
            </div>
            <div class="column">
              <div class="field">
                <label class="label"><a class="button is-link">From other roles</a></label>
                <div class="control">
                  <v-select
                    v-model="newRoleParent"
                    label="name"
                    placeholder="Select a Role"
                    maxHeight='4rem'
                    :options="roles">
                  </v-select>
                </div>
              </div>
            </div>
          </div>
        </section>
        <footer class="modal-card-foot">
          <button class="button is-success" @click="saveRole">Save changes</button>
          <button class="button" @click="newRole = false">Cancel</button>
        </footer>
      </div>
    </div> -->
  </div>
</template>

<script>
import RoleView from './RoleView.vue';
import CreateRole from './CreateRole.vue';
import vSelect from "vue-select";

export default {
  data: function() {
    return {
      newRole: false,
      roleName: '',
      error: false,
      roles: [],
      selectedRole: null,
      roleSearch: '',
      filteredRoles: [],
      newRoleParent: null
    }
  },
  created: function(){
    console.log(this.testMessage);
    this.getRoles();
  },
  methods: {
    addNewRole: function(){
      this.newRole = true;
    },
    saveRole: function(){
      if (this.roleName.length > 0){
        axios.post('/user/roles/create', {
          role_name: this.roleName
        }).then(response => {
          console.log("RESPONSE");
          console.log(response);
          this.newRole = false;
          this.getRoles();
        }).catch(error => {
          console.log("ERROR");
          console.log(error);
        })
      } else {
        this.error = true;
      }
    },
    filterRoles: function(){
      if (this.roleSearch.length > 0) {
        this.filteredRoles = _.filter(this.roles, (role) => {
          return role.name == this.roleSearch;
        })
      } else {
        this.filteredRoles = this.roles;
      }
    },
    clearSearch: function(){
      this.filteredRoles = this.roles;
      this.roleSearch = "";
    },
    getRoles: function(){
      axios.get('/user/roles/get')
        .then(response => {
          console.log("RESPONSE");
          console.log(response);
          this.roles = response.data;
          this.filteredRoles = this.roles;
        })
        .catch(error => {
          console.log("ERROR");
          console.log(error);
        });
    },
    closeRoleView: function(){
      this.selectedRole = null;
      this.getRoles();
    },
    closeCreateRole: function(){
      this.newRole = false;
      this.getRoles();
    }
  },
  components: {
    'v-select': vSelect,
    'role-view': RoleView,
    'create-role': CreateRole
  }
}
</script>

<style lang="scss">
  .modal-card-body{
    padding-bottom: 5rem;
  }
</style>
