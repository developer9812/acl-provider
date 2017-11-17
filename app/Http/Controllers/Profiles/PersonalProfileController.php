<?php

namespace App\Http\Controllers\Profiles;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Address;
use App\Models\Profiles\PersonalProfile;
use App\Models\Address;
use Carbon\Carbon;

class PersonalProfileController extends Controller
{
    public function getPersonalProfile(User $user)
    {

    }

    public function createProfile(Request $request)
    {
      $profileData = $request->input('profile');
      $relations = $request->input('relations');
      $permanentAddress = Address::create($request->input('relations.permanentAddress'));
      $residenceAddress = Address::create($request->input('relations.residenceAddress'));
      $profile = new PersonalProfile($profileData);
      $profile->dob = Carbon::parse($request->input('profile.dob'));
      $profile->permanentAddress()->associate($permanentAddress);
      $profile->residenceAddress()->associate($residenceAddress);
      $profile->user()->associate(Auth::user());
      $profile->save();
      return json_encode($profile);
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
      elseif (Schema::hasColumn($table, $attribute))
      {
        $profile->{$attribute} = $request->input('value');
        $profile->save();
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
