<?php

namespace App\Http\Controllers\Profiles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Address;
use App\Models\Profiles\PersonalProfile;

class PersonalProfileController extends Controller
{
    public function getPersonalProfile(User $user)
    {

    }

    public function createProfile(Request $request)
    {
      $profileData = $request->get('profile');
      // $profile = PersonalProfileController::create()
      $permanentAddress = Address::create($request->get('relations.permanentAddress'));
      $residenceAddress = Address::create($request->get('relations.residenceAddress'));
      $profile = new PersonalProfile( $profileData);
      $profile->dob = \Carbon\Carbon::parse($profileData['dob']);
      $profile->permanentAddress()->associate($permanentAddress);
      $profile->residenceAddress()->associate($residenceAddress);
      $profile->user()->associate(Auth::user());
      $profile->save();
      return json_encode($profile);
    }
}
