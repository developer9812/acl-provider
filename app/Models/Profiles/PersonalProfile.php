<?php

namespace App\Models\Profiles;

use Illuminate\Database\Eloquent\Model;

class PersonalProfile extends Model
{
    protected $fillable = ['title', 'first_name', 'middle_name', 'last_name', 'nick_name',
      'picture', 'permanent_address_id', 'residence_address_id', 'dob', 'gender'
    ];

    public function user()
    {
      return $this->belongsTo("App\User", 'user_id', 'user_id');
    }

    public function permanentAddress()
    {
      return $this->belongsTo('App\Models\Address', 'permanent_address_id');
    }

    public function residenceAddress()
    {
      return $this->belongsTo('App\Models\Address', 'residence_address_id');
    }

    public function phones()
    {
      return $this->hasMany('App\Models\Phone');
    }

    public function emails()
    {
      return $this->hasMany('App\Models\Email');
    }
}
