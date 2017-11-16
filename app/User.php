<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function findForPassport($identifier) {
        return $this->orWhere('email', $identifier)
                    ->orWhere('username', $identifier)
                    ->first();
    }

    public function roleOwner()
    {
      return $this->hasMany('App\Models\RoleOwner');
    }

    public function personalProfile()
    {
      return $this->hasOne('App\Models\Profiles\PersonalProfile');
    }

}
