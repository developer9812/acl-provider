<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
      login as traitLogin;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->revokeTokens();
        return $this->traitLogin($request);
    }

    private function revokeTokens()
    {
      $username = request()->input($this->username());
      if (User::where($this->username(), '=', $username)->exists()) {
        $user = User::where($this->username(), '=', $username)->first();
        $tokens = $user->tokens;
        foreach($tokens as $token) {
          $token->revoke();
        }
      }
    }

    public function username()
    {
        $login = request()->input('username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }

    public function ajaxLogin(Request $request)
    {
      Log::info("USER");
      Log::info($request->get('username'));
      $status = Auth::attempt([
        'username' => $request->get('username'),
        'password' => $request->get('password')
      ]);
      Log::info(Auth::user()->username);
      return json_encode([
        'status' => $status,
        'user' => Auth::user()
      ]);
    }

    public function authStatus()
    {
      Log::info(Auth::user()->username);
      return json_encode([
        'status' => Auth::check()
      ]);
    }
}
