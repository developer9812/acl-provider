<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User Management</title>
    <link rel="stylesheet" href="/css/main.css">
  </head>
  <body>
    <div id="app" >
      <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
          <a class="navbar-item nav-title">
            User Management
          </a>
        </div>
      </nav>
      <section class="section">
        <nav class="level">
          <div class="level-left">
            <div class="level-item">
              <div class="field has-addons">
                <p class="control">
                  <input class="input" type="text" v-model="userSearch" placeholder="Find a user">
                </p>
                <p class="control">
                  <button class="button" @click="filterUsers">
                    Search
                  </button>
                </p>
              </div>
            </div>
          </div>
        </nav>
        <table class="table is-fullwidth">
          <thead>
            <tr>
              <th>ID</th>
              <th>Username</th>
              <th>Name</th>
              <th>Email ID</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for='user in filteredUsers'>
              <td>@{{ user.id }}</td>
              <td>@{{ user.username }}</td>
              <td>@{{ user.name }}</td>
              <td>@{{ user.email }}</td>
              <td><a href="#" class="button is-small" @click="selectedUser = user">View</a></td>
            </tr>
          </tbody>
        </table>
      </section>

      <user-view
        :user="selectedUser"
        :show-view="selectedUser != null"
        v-if="selectedUser != null"
        @close-user-view="closeUserView">
      </user-view>

    </div>
    <script type="text/javascript" src="{{URL::asset('js/user.js')}}"></script>
  </body>
</html>
