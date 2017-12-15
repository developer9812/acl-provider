<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    public function profile()
    {
      $this->belongsTo('App\Models\Profiles\PersonalProfile', 'profile_id');

    }
}
