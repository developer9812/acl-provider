<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:25',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user_id = unique_user_id();
        Log::info("CREATE USER");
        Log::info($user_id);
        return User::create([
            'name' => $data['name'],
            'user_id' => $user_id,
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'user_id' => unique_user_id()
        ]);
    }

    public function createFromApi(Request $request)
    {
      // $this->validate($request, [
      //     'role' => 'required',
      //     'user' => 'JSON',
      //     'user.user_id' => 'required|string|min:16|max:16|unique:users',
      //     'user.name' => 'required|string|max:255',
      //     'user.username' => 'required|string|max:25|unique:users',
      //     'user.password' => 'required|string|min:6',
      //     'user.email' => 'nullable|string|email|max:255|unique:users'
      // ]);
      $role = $request->input('role');
      if (Role::whereName($role)->exists())
      {
        // return json_encode($request->input('user'));
        $user = User::create([
          'user_id' => $request->input('user.user_id'),
          'username' => $request->input('user.username'),
          'name' => $request->input('user.name'),
          'password' => bcrypt($request->input('user.password')),
          'email' => $request->input('user.email')
        ]);

        $user->syncRoles([$role]);
        return json_encode($user);
      } else {
        abort(422, 'Role does not exists');
      }
    }
}
