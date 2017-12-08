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
      if ($request->has('permission')){
        if (Permission::whereName($request->input('permission'))) {

        }
      }
    }
}
