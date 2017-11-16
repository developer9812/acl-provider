<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/users', 'UserController@getUsers')->middleware('auth:api');
// Route::get('/user/role', 'Auth\PermissionController@getPermissions')->middleware('auth:api');
//
// Route::get('/user/status', 'UserController@getStatus')->middleware('auth:api');


Route::middleware('auth:api')->group(function(){
  Route::get('/user', 'UserController@index');
  Route::get('/users', 'UserController@getUsers');
  Route::delete('/user/{user}', 'UserController@delete');

  Route::get('/user/role', 'Auth\PermissionController@getPermissions');
  Route::get('/user/status', 'UserController@getStatus');

  Route::get('/user/roles', 'UserRoleController@index');
  Route::get('/user/roles/get', 'UserRoleController@getRoles');
  Route::post('/user/roles/create', 'UserRoleController@createRole')->middleware('can:add-role');
  Route::post('/user/roles/permission/update', 'UserRoleController@updatePermissions');
  Route::get('/user/roles/permission', 'UserRoleController@getPermissions');
  Route::delete('/user/role/{role}', 'UserRoleController@deleteRole');
  Route::post('/user/role/set', 'UserController@setRole');
  Route::get('/user/{user}/role', 'UserController@getCurrentRole');
  Route::get('/user/permissions', 'Auth\PermissionController@getPermissions');
});
