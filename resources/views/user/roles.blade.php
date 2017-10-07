<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User Role Management</title>
    <link rel="stylesheet" href="/css/main.css">
  </head>
  <body>
    <div id="app" >
      <nav class="navbar" role="navigation" aria-label="main navigation">
        <a class="navbar-item" @click="toggleMenu"><i class="fa fa-bars"></i></a>
        <div class="navbar-brand">
          <a class="navbar-item nav-title">
            User Roles
          </a>
        </div>
      </nav>
      <div class="columns main-content is-marginless">
        <div class="column is-narrow menu-container is-paddingless">
          <transition name="slide">
            <menu-view v-if="showMenu"></menu-view>
          </transition>
        </div>
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
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for='role in filteredRoles'>
                  <td>@{{ role.id }}</td>
                  <td>@{{ role.name }}</td>
                  <td>@{{ role.created_at }}</td>
                  <td>@{{ role.updated_at }}</td>
                  <td><a href="#" class="button is-small" @click="selectedRole = role">View</a></td>
                </tr>
              </tbody>
            </table>
          </section>

          <role-view :role="selectedRole" :show="selectedRole != null" v-if="selectedRole != null" @close-role-view="closeRoleView"></role-view>

          <div class="modal" :class="{'is-active': newRole}">
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
              </section>
              <footer class="modal-card-foot">
                <button class="button is-success" @click="saveRole">Save changes</button>
                <button class="button" @click="newRole = false">Cancel</button>
              </footer>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="{{URL::asset('js/roles.js')}}"></script>
  </body>
</html>
