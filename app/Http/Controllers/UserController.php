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
        $role = Auth::user()->roles()->first()->load('children');
        $roleMap = new RoleFlatMap($role->children);
        return json_encode(User::role($roleMap->getRoles())->get());
      }
    }

    public function index()
    {
      return view('user.users');
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
      $user->syncRoles([$role->name]);
      event('auth.logout', [$user]);
      return json_encode($user->roles()->get());
    }

    public function getCurrentRole(User $user)
    {
      $role = $user->roles()->first();
      return json_encode($role);
    }

    public function getStatus()
    {
      Log::info(Auth::user()->username);
      return json_encode([
        'status' => Auth::check()
      ]);
    }
}
