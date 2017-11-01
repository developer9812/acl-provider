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
      axios.get('/api/user/roles/get')
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
