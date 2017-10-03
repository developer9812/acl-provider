<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

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
}
