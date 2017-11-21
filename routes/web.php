<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'HomeController@index');
// Route::get('/user/status', 'Auth\LoginController@authStatus');

// Illuminate\Routing\Router
Auth::routes();

// Route::namespace('Auth')->group(function () {
//   $this->get('login', '\App\Http\Controllers\HomeController@index')->name('login');
//   $this->post('login', 'LoginController@login');
//   $this->post('logout', 'LoginController@logout')->name('logout');
//
//   // Registration Routes...
//   $this->get('register', 'RegisterController@showRegistrationForm')->name('register');
//   $this->post('register', 'RegisterController@register');
//
//   // Password Reset Routes...
//   $this->get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
//   $this->post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//   $this->get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
//   $this->post('password/reset', 'ResetPasswordController@reset');
// });

Route::post('/ajax/login', 'Auth\LoginController@ajaxLogin');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/passport', 'Auth\PassportController@index');

Route::get('/admin/oauth', 'AdminController@index');
Route::get('/admin/oauth/clients', 'AdminController@getAllClients');

// Route::get('/admin/oauth/expiry', 'AdminController@getTokenExpiry');
// Route::post('/admin/oauth/expiry/update', 'AdminController@updateTokenExpiry');

Route::get('/ajax/acl', 'UserController@getRole');

Route::get('routes', function() {
    $routeCollection = Route::getRoutes();
    foreach ($routeCollection as $key => $value) {
      if (substr($value->uri, 0 , 3) == 'api')
      {
        print_r($key);
        echo "&nbsp;&nbsp;";
        print_r($value->uri);
        echo "<br />";
      }
    }
});

Route::get('auth/social/{provider}', 'Auth\SocialiteController@redirectToProvider');
Route::get('auth/social/{provider}/callback', 'Auth\SocialiteController@handleProviderCallback');

Route::get('{path}', function () {
    return view('index');
})->where('path', '(.*)');
