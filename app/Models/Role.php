<?php

namespace App\Models;

/**
 *
 */
class Role extends \Spatie\Permission\Models\Role
{

  public function owner()
  {
    return $this->belongsTo('App\User', 'owner_id');
  }

  public function parent()
  {
    return $this->belongsTo('App\Models\Role', 'parent_id');
  }

  public function children()
  {
    return $this->hasMany('App\Models\Role', 'parent_id')->with([
      'children' => function($query){
        return $query->with(['parent', 'owner']);
      }
    ]);
  }

}

 ?>
