<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Helpers\RoleFlatMap;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUsers()
    {
      if ( Auth::user()->hasAnyPermission( config('permissionmap.role') ) )
      {
        return json_encode(User::all());
      }
      else
      {
        $role = Auth::user()->roles()->get()->load([
          'children' => function($query){
            return $query->with(['parent', 'owner']);
          }
        ]);
        $roleMap = new RoleFlatMap($role, Auth::user()->roles()->get() );
        return json_encode(User::role($roleMap->getRoles())->get());
      }
    }

    public function index()
    {
      return view('user.users');
    }

    public function verifyToken()
    {
      $user = Auth::user();
      $token = $user->token();
      return json_encode([
        'user' => $user,
        'token' => $token
      ]);
    }

    public function delete(User $user)
    {
      $status = $user->delete();
      return (json_encode(['status' => $status]));
    }

    public function getRole()
    {
      return json_encode(Auth::user()->roles()->with([
        'permissions' => function($query){
          return $query->get(['id', 'name']);
        }
      ])->get());
    }

    public function setRole(Request $request)
    {
      $role = Role::find($request->get('role'));
      $user = User::find($request->get('user'));
      $user->assignRole($role);
      // $user->syncRoles([$role->name]);
      event('auth.logout', [$user]);
      return json_encode($user->roles()->get());
    }

    public function removeRole(Request $request)
    {
      $role = Role::find($request->get('role'));
      $user = User::find($request->get('user'));
      $user->removeRole($role);
      event('auth.logout', [$user]);
      return json_encode($user->roles()->get());      
    }

    public function getCurrentRole(User $user)
    {
      $role = $user->roles()->first();
      return json_encode($role);
    }

    public function getAssociatedRoles(User $user)
    {
      $roles = $user->roles()->get();
      return json_encode($roles);
    }

    public function getStatus()
    {
      Log::info(Auth::user()->username);
      return json_encode([
        'status' => Auth::check()
      ]);
    }

    public function getOauthUser()
    {
      $user = Auth::user();
      return json_encode($user->load(['personalProfile', 'roles.permissions']));
    }
}
