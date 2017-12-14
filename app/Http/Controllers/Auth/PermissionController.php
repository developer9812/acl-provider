<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function getPermissions()
    {
      return json_encode(Auth::user()->roles()->with([
        'permissions' => function($query){
          return $query->get(['id', 'name']);
        }
      ])->get());
      // return json_encode(Auth::user()->getAllPermissions());
    }

    public function syncPermissions(Request $request)
    {

    }

    public function fetchPermissions()
    {
      return Permission::all()->toJson();
    }

    public function savePermission(Request $request)
    {
      if ($request->has('permission') and strlen($request->input('permission')) > 1){
        if (Permission::whereName($request->input('permission'))->exists()) {
          abort(422, 'Permission already exists');
        } else {
          $permission = Permission::create([
            'name' => $request->input('permission'),
            'user_defined' => true,
            'guard_name' => 'web'
          ]);
          return json_encode([
            'status' => true,
            'permission' => $permission
          ]);
        }
      } else {
        abort(422, 'Provide a valid permission name');
      }
    }

    public function updatePermission(Permission $permission, Request $request)
    {
      if ($request->has('permission') and strlen($request->input('permission')) > 1){
        if (Permission::whereName($request->input('permission'))->exists()) {
          abort(422, 'Permission already exists');
        } else {
          $permission->name = $request->input('name');
          $permission->save();
          return json_encode([
            'status' => true,
            'permission' => $permission
          ]);
        }
      } else {
        abort(422, 'Provide a valid permission name');
      }
    }

    public function deletePermission(Permission $permission)
    {
      $status = $permission->delete();
      return json_encode([
        'status' => $status
      ]);
    }
}
