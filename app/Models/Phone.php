<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    public function profile()
    {
      return $this->belongsTo('App\Models\Profiles\PersonalProfile', 'profile_id');
    }
}
