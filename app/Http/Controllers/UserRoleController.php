<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRoleController extends Controller
{
    public function index()
    {
      return view('user.roles');
    }

    public function createRole(Request $request)
    {
      $role = Role::create( ['name' => $request->get('role_name')]);
      return json_encode($role);
    }

    public function getRoles(Request $request)
    {
      return json_encode(Role::all());
    }

    public function getPermissions(Request $request)
    {
      return json_encode([
        'role_permissions' => Role::find($request->get('role'))->permissions()->get(),
        'permissions' => Permission::all()
      ]);
    }

    public function updatePermissions(Request $request)
    {
      $role = Role::find($request->get('role'));
      Log::info(serialize($request->get('permissions')));
      $role->syncPermissions(collect($request->get('permissions'))->pluck('name'));
      return json_encode($role->permissions()->get());
    }

    public function deleteRole(Role $role)
    {
      $result = $role->delete();
      return json_encode($result);
    }
}