<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OauthClient;

class AdminController extends Controller
{
    public function index()
    {
      return view( 'admin.oauth');
    }

    public function getAllClients()
    {
      return json_encode(OauthClient::all());
    }
}
