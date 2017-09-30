<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OAuth Client Management</title>
    <link rel="stylesheet" href="/css/main.css">
  </head>
  <body>
    <div id="app" >
      <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
          <a class="navbar-item nav-title">
            Oauth Admin
          </a>
        </div>
      </nav>
      <section class="hero is-dark">
        <div class="hero-body">
          <div class="container">
            <h1 class="title">
              Oauth Clients
            </h1>
            <h2 class="subtitle">
              Manage Registered Clients for API Authentication
            </h2>
          </div>
        </div>
      </section>
      <div class="tabs">
        <ul>
          <li :class="{'is-active': activeTab == 'password-grant'}"><a @click="activeTab = 'password-grant'">Password Grant</a></li>
          <li><a>OAuth Clients</a></li>
          <li><a>Personal Access Tokens</a></li>
          <li :class="{'is-active': activeTab == 'settings'}"><a @click="activeTab = 'settings'">Settings</a></li>
        </ul>
      </div>
      <section class="section" v-if="activeTab == 'password-grant'">
       <div class="container">
         <password-grant-view></password-grant-view>
       </div>
     </section>
     <section class="section" v-if="activeTab == 'settings'">
       <div class="container">
         Token Expiry Time
         <div class="field has-addons">
          <p class="control">
            <span class="select">
              <select v-model="expiryUnit">
                <option value='second'>Sec</option>
                <option value='minute'>Min</option>
                <option value='hour'>Hr</option>
              </select>
            </span>
          </p>
          <p class="control">
            <input class="input" type="text" placeholder="Token Expiry Time" v-model="tokenExpiry">
          </p>
          <p class="control">
            <a class="button" @click="updateExpiry">
              Update
            </a>
          </p>
        </div>
       </div>
     </section>
    </div>
    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
  </body>
</html>
