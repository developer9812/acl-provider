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
          <li class="is-active"><a>Password Grant</a></li>
          <li><a>OAuth Clients</a></li>
          <li><a>Personal Access Tokens</a></li>
        </ul>
      </div>
      <section class="section">
       <div class="container">
         <password-grant-view></password-grant-view>
       </div>
     </section>
     <section class="section">
       <div class="container">
         Token Expiry Time
       </div>
     </section>
    </div>
    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
  </body>
</html>
