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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/passport', 'Auth\PassportController@index');

Route::get('/admin/oauth', 'AdminController@index');
Route::get('/admin/oauth/clients', 'AdminController@getAllClients');

Route::get('/admin/oauth/expiry', 'AdminController@getTokenExpiry');
Route::post('/admin/oauth/expiry/update', 'AdminController@updateTokenExpiry');

Route::get('/user', 'UserController@index');
Route::get('/users', 'UserController@getUsers');
Route::get('/user/roles', 'UserRoleController@index');
Route::get('/user/roles/get', 'UserRoleController@getRoles');
Route::post('/user/roles/create', 'UserRoleController@createRole');
Route::post('/user/roles/permission/update', 'UserRoleController@updatePermissions');
Route::get('/user/roles/permission', 'UserRoleController@getPermissions');
Route::delete('/user/role/{role}', 'UserRoleController@deleteRole');
Route::post('/user/role/set', 'UserController@setRole');
Route::get('/user/{user}/role', 'UserController@getCurrentRole');
Route::get('/user/permissions', 'Auth\PermissionController@getPermissions');

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
