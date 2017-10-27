<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Helpers\RoleFlatMap;
use Spatie\Permission\Models\Permission;

class UserRoleController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      return view('user.roles', [
        'permissions' => Auth::user()->getAllPermissions()
      ]);
    }

    public function createRole(Request $request)
    {
      $role = new Role();
      $role->name = $request->get('role_name');
      if ($request->has('parent_role')) {
        $role->parent()->associate(Role::whereName($request->get('parent_role'))->first());
      } else {
        $role->parent()->associate(Auth::user()->roles()->first());
      }
      $role->owner()->associate(Auth::user());
      $role->save();
      return json_encode($role);
    }

    public function getRoles(Request $request)
    {
      $role = Auth::user()->roles()->get()->load([
        'children' => function($query){
          return $query->with(['parent', 'owner']);
        }
      ]);
      $roleMap = new RoleFlatMap($role, Auth::user()->roles()->get() );
      return json_encode( $roleMap->getRoles());
    }

    public function getPermissions(Request $request)
    {
      return json_encode([
        'role_permissions' => Role::find($request->get('role'))->permissions()->get(),
        'permissions' => Auth::user()->getAllPermissions()
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
