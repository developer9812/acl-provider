<template lang="html">
  <div class="modal is-active">
    <div class="modal-background" @click="closeView"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">New Role</p>
        <button class="delete" aria-label="close" @click="closeView"></button>
      </header>
      <section class="modal-card-body">
        <div class="field">
          <label class="label">Name of the role</label>
          <div class="control">
            <input class="input" type="text" placeholder="eg: admin" v-model="roleName">
          </div>
          <p class="help is-danger" v-if="error">Enter a valid name</p>
        </div>
        <hr>
        <div class="field">
          <label class="label">Define a Parent Role</label>
        </div>
        <div class="tabs is-boxed">
          <ul>
            <li :class="{'is-active': ownRoleParent}" @click="ownRoleParent = true"><a>From own roles</a></li>
            <li :class="{'is-active': !ownRoleParent}" @click="ownRoleParent = false"><a>From other roles</a></li>
          </ul>
        </div>
        <div class="field" v-if="ownRoleParent">
          <div class="control">
            <v-select
              v-model="newRoleParent"
              label="name"
              placeholder="Select own role"
              maxHeight='4rem'
              :disabled="!ownRoleParent"
              :options="ownRoles">
            </v-select>
          </div>
        </div>

        <div class="field" v-else>
          <div class="control">
            <v-select
              v-model="newRoleParent"
              label="name"
              placeholder="Select a role"
              maxHeight='4rem'
              :disabled="ownRoleParent"
              :options="roles">
            </v-select>
          </div>
        </div>
      </section>
      <footer class="modal-card-foot">
        <button class="button is-success" @click="saveRole">Save changes</button>
        <button class="button" @click="closeView">Cancel</button>
      </footer>
    </div>
  </div>
</template>

<script>
import vSelect from 'vue-select';

export default {
  props: {
    roles: {
      type: Array,
      default: null
    }
  },
  data: function(){
    return {
      newRoleParent: null,
      roleName: '',
      error: false,
      ownRoles: [],
      ownRoleParent: true
    }
  },
  created: function(){
    this.getUserRoles();
  },
  methods: {
    getUserRoles: function(){
      axios.get('/api/user/role')
      .then(response => {
        console.log("GET OWN ROLE RESPONSE");
        console.log(response);
        this.ownRoles = response.data;
      })
      .catch(error => {
        console.log("GET OWN ROLE ERROR");
        console.log(error);
        alert("Cannot detect user role");
      })
    },
    saveRole: function(){
      if (this.roleName.length > 0){
        let parentRole = null;
        if (this.newRoleParent) {
          parentRole = this.newRoleParent.name;
        }
        else {
          this.error = true;
        }
        axios.post('/api/user/roles/create', {
          role_name: this.roleName,
          parent_role: parentRole
        }).then(response => {
          console.log("RESPONSE");
          console.log(response);
          this.$emit('close-view');
        }).catch(error => {
          console.log("ERROR");
          console.log(error);
          this.error = true;
        })
      } else {
        this.error = true;
      }
    },
    closeView: function(){
      this.$emit('close-view');
    }
  },
  components: {
    vSelect,
  },
  watch: {
    'ownRoleParent': function(){
      this.newRoleParent = null;
    }
  }
}
</script>

<style lang="scss">
  .tabs{
    ul{
      li{
        a{
          transition: all 0.2s ease;
        }
      }
    }
  }
</style>
