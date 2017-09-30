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

    public function updateTokenExpiry(Request $request)
    {
        config(['general.passport_token_expiry' => $request->get('token_expiry')]);
        return json_encode([
          'value' => $request->get('token_expiry'),
          'default' => config( 'general.passport_token_expiry')
        ]);
    }

    public function getTokenExpiry()
    {
      return json_encode(['value' => config( 'general.passport_token_expiry')]);
    }
}
