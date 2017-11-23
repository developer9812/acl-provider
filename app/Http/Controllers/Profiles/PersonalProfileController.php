<?php

namespace App\Http\Controllers\Profiles;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Address;
use App\Models\Profiles\PersonalProfile;
use Carbon\Carbon;

class PersonalProfileController extends Controller
{
    public function getProfile()
    {
      $profile = Auth::user()->personalProfile->load(['permanentAddress', 'residenceAddress','user']);
      return json_encode($profile);
    }

    public function createProfile(Request $request)
    {
      $profileData = $request->input('profile');
      $relations = $request->input('relations');
      if (PersonalProfile::whereUserId(Auth::user()->user_id)->exists()) {
        return json_encode([
          'status' => false,
          'message' => 'Profile already exists'
        ]);
      }
      $profile = new PersonalProfile($profileData);
      $profile->dob = Carbon::parse($request->input('profile.dob'));

      $permanentAddress = Address::create($request->input('relations.permanentAddress'));
      $profile->permanentAddress()->associate($permanentAddress);
      if ($request->input('commonAddress')) {
        $profile->residenceAddress()->associate($permanentAddress);
      } else {
        $residenceAddress = Address::create($request->input('relations.residenceAddress'));
        $profile->residenceAddress()->associate($residenceAddress);
      }

      $profile->user()->associate(Auth::user());
      $profile->save();
      return json_encode([
        'status' => true,
        'profile' => $profile
      ]);
    }

    public function updateProfileAttribute(Request $request, PersonalProfile $profile, string $attribute)
    {
      $table = $profile->getTable();
      if ($attribute == 'permanentAddress')
      {
        $address = $profile->permanentAddress;
        $address->update($request->input('value'));
        return json_encode($profile->load('permanentAddress'));
      }
      elseif ($attribute == 'residenceAddress')
      {
        $address = $profile->residenceAddresss;
        $address->update($request->input('value'));
        return json_encode($profile->load('residenceAddresss'));
      }
      elseif ($attribute == 'name')
      {
        $name = $request->input('value');
        foreach($name as $key => $value) {
          if (Schema::hasColumn($table, $key)) {
            $profile->{$key} = $value;
          }
        }
        $profile->save();
        return json_encode($profile);
      }
      elseif (Schema::hasColumn($table, $attribute))
      {
        if ($attribute == 'dob') {
          $profile->dob = Carbon::parse($request->input('value'));
          $profile->save();  
        } else {
          $profile->{$attribute} = $request->input('value');
          $profile->save();
        }
        return json_encode($profile);
      }
      else
      {
        return json_encode(['status' => false, 'error' => 'Invalid Attribute']);
      }
    }

    public function deleteProfile(PersonalProfile $profile)
    {
      $status = $profile->delete();
      return json_encode(['status' => $status]);
      //@todo remove associated addresses also
    }
}
