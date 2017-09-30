<template>
  <div class="password-view">
    All Clients
    <div class="column">

      <table class="table is-striped is-narrow is-fullwidth" >
        <thead>
          <tr>
            <th>Name</th>
            <th>Client ID</th>
            <th>Client Secret</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="client in clients">
            <td>{{ client.name }}</td>
            <td>{{ client.password_client }}</td>
            <td>{{ client.secret }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data: function(){
    return {
      clients: []
    }
  },
  created: function(){
    axios.get('/admin/oauth/clients')
      .then( response => {
        console.log(response);
        this.clients = response.data;
      })
      .catch( error => {

      })
  }
}
</script>

<style lang="scss">
.table{
  width: 100%;
}
</style>
