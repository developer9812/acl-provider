<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
     "block_no",
     "building",
     "landmark",
     "street",
     "city",
     "subdistrict",
     "district",
     "district_iso",
     "state",
     "state_iso",
     "country",
     "country_iso",
     "pincode",
   ];
}
