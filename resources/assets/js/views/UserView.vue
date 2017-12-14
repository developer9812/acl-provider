<template lang="html">
  <div class="modal" :class="{'is-active': viewUser}">
    <div class="modal-background" @click="closeView"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">User View</p>
        <button class="delete" aria-label="close" @click="closeView"></button>
      </header>
      <section class="modal-card-body">

        <nav class="level">
          <div class="level-left">
            <div class="level-item">
              <p class="subtitle is-5">
                <strong>User: {{ user.username }}</strong>
              </p>
            </div>
          </div>

          <div class="navbar-end">
           <div class="navbar-item">
               <a class="button is-outlined is-danger" @click="deleteUser">
                 Delete User
               </a>
           </div>
         </div>
        </nav>

        <div class="column">
          <div class="content">
            <p class="content is-small"><strong>Username</strong></p>
            <p>{{ user.username }}</p>
          </div>
          <div class="content">
            <p class="content is-small"><strong>Email</strong></p>
            <p>{{ user.email }}</p>
          </div>
          <div class="content">
            <p class="content is-small"><strong>Roles</strong></p>
            <div class="field is-grouped is-grouped-multiline">
              <div class="control" v-for="associatedRole in associatedRoles">
                <div class="tags has-addons">
                  <a class="tag is-primary">{{associatedRole.name}}</a>
                  <a class="tag is-delete" @click="removeRole(associatedRole.id)"></a>
                </div>
              </div>
              <div class="control">
                <a class="button is-small" @click="showRoleList = true">
                  <!-- <span class="icon">
                    <i class="fa fa-plus"></i>
                  </span> -->
                  <span>Add Role</span>
                </a>
              </div>
            </div>
          </div>
          <div class="content" v-if="showRoleList">
            <p class="content is-small">Select a role</p>
            <v-select
              :options="roles"
              label="name"
              placeholder="Select a Role"
              max-height="300px"
              v-model="selectedRole">
            </v-select>
            <a class="button is-primary" @click="saveNewRole">
              <span class="icon">
                <i class="fa fa-save"></i>
              </span>
              <span>Save</span>
            </a>
            <a class="button" @click="showRoleList = false">
              <!-- <span class="icon">
                <i class="fa fa-times"></i>
              </span> -->
              <span>Cancel</span>
            </a>
          </div>
        </div>
        <div v-if="showMessage" class="notification is-success">
          <p v-if="message">{{ message }}</p>
        </div>
      </section>
      <footer class="modal-card-foot">
        <!-- <button class="button is-success" @click="submit">Save changes</button>
        <button class="button" @click="closeView">Cancel</button> -->
      </footer>
    </div>
  </div>
</template>

<script>
import vSelect from "vue-select";
import Message from "../components/Message.vue"

export default {
  props: {
    user: {
      type: Object,
      required: true
    },
    showView: {
      type: Boolean,
      default: false
    }
  },
  data: function(){
    return {
      viewUser: this.showView,
      roles: [],
      selectedRole: null,
      associatedRoles: [],
      showMessage: false,
      showRoleList: false,
      message: 'Success, Changes have been saved.'
    }
  },
  mounted: function(){
    console.log("UserView CREATED");
    this.getRoles();
    this.getAssociatedRoles();
  },
  methods: {
    getAssociatedRoles: function(){
      axios.get('/api/user/' + this.user.id + '/roles/')
      .then(response => {
        console.log("ASSOCIATED ROLES");
        console.log(response.data);
        this.associatedRoles = response.data;
        this.associatedRoles.forEach((role) => {
          this.updatedRoles.push(role.name);
        })
      })
      .catch(error => {
        console.log("ERROR IN FETCHING ROLES");
      })
    },
    getRoles: function(){
      axios.get('/api/user/roles/get')
        .then( response => {
          console.log("Fetched Roles List");
          console.log(response);
          this.roles = response.data;
        })
        .catch( error => {
          console.log("ERROR");
          console.log(error);
        });
    },
    saveNewRole: function(){
      if (this.selectedRole) {
        axios.post('/api/user/role/add', {
          role: this.selectedRole.id,
          user: this.user.id
        }).then(response => {
          console.log("ADD ROLE RESPONSE");
          console.log(response.data);
          this.getAssociatedRoles();
          this.showRoleList = false;
          this.displayMessage();
        }).catch(error => {
          console.log("ADD ROLE ERROR");
          console.log(error);
        });
      }
    },
    removeRole: function(id){
      axios.post('/api/user/role/remove', {
        role: id,
        user: this.user.id
      }).then(response => {
        console.log("REMOVE ROLE RESPONSE");
        console.log(response.data);
        this.getAssociatedRoles();
        this.displayMessage();
      }).catch(error => {
        console.log("REMOVE ROLE ERROR");
        console.log(error);
      })
    },
    deleteUser: function(){
      axios.delete('/api/user/' + this.user.id)
        .then(response => {
          if (response.data.status) {
            alert('User Deleted');
            this.closeView();
          }
        })
        .catch(error => {
            alert('User not deleted');
        })
    },
    displayMessage: function(){
      this.showMessage = true;
      setTimeout(() => {
        this.showMessage = false;
      }, 3000);
    },
    closeView: function(){
      this.viewUser = false;
      this.$emit('close-user-view');
    },

  },
  watch: {
    'showView': function(){
      this.viewUser = this.showView;
    }
  },
  components: {
    'v-select': vSelect,
    'message': Message
  }
}
</script>

<style lang="scss">
</style>
