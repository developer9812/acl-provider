<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUsers()
    {
      return json_encode(User::all());
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
      return json_encode($user->roles()->get());
    }

    public function getCurrentRole(User $user)
    {
      $role = $user->roles()->first();
      return json_encode($role);
    }
}
