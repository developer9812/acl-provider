<template lang="html">
  <div class="modal" :class="{'is-active': viewUser}">
    <div class="modal-background" @click="closeView"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">User: {{ user.name }}</p>
        <button class="delete" aria-label="close" @click="closeView"></button>
      </header>
      <section class="modal-card-body">
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
            <p class="content is-small"><strong>Role</strong></p>
            <v-select
              :options="roles"
              label="name"
              placeholder="Select a Role"
              max-height="300px"
              v-model="selectedRole">
            </v-select>
          </div>
        </div>
        <div v-if="showMessage" class="notification is-success">
          <p v-if="message">{{ message }}</p>
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
      showMessage: false,
      message: 'Success, Changes have been saved.'
    }
  },
  mounted: function(){
    console.log("UserView CREATED");
    this.getRoles();
    this.getCurrentRole();
  },
  methods: {
    getCurrentRole: function(){
      axios.get('/user/' + this.user.id + '/role/')
        .then(response => {
          console.log("Fetched Current Role");
          console.log(response.data);
          this.selectedRole = response.data;
        })
    },
    getRoles: function(){
      axios.get('/user/roles/get')
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
    submit: function(){
      if (this.selectedRole) {
        axios.post('/user/role/set', {
          role: this.selectedRole.id,
          user: this.user.id
        }).then(response => {
          console.log("RESPONSE");
          console.log(response.data);
          this.displayMessage();
        }).catch(error => {
          console.log("ERROR");
          console.log(error);
        });
      }
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
    }

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
