<?php

namespace App\Helpers;
use Illuminate\Support\Collection;

class RoleFlatMap {

  private $role;
  private $result = [];
  private $exclude = [];
  private $removed = [];
  private $parentRoles;

  public function __construct($role, Collection $parentRoles)
  {
    $this->role = $role;
    $this->exclude = $parentRoles->pluck('name')->toArray();
    $this->parentRoles = $parentRoles;
  }

  public function getRoles()
  {
    if (is_iterable($this->role)) {
      foreach ($this->role as $role) {
        $this->flatten($role);
      }
    } else {
      $this->flatten($this->role);
    }
    $result = $this->result;
    $this->result = [];
    $this->checkChildRoles();
    return $result;
  }

  public function flatten($role)
  {
    if (!in_array($role->name, $this->exclude)) {
      array_push( $this->result, $role );
    } else {
      array_push( $this->removed, $role );
    }
    if ( is_iterable( $role->children ) ) {
      foreach ( $role->children as $child ) {
        $this->flatten($child);
      }
    }
  }

  public function checkChildRoles()
  {
    foreach ($this->removed as $rmKey => $removedRole) {
      foreach ($this->result as $addedRole) {
        if ($removedRole->parent_id == $addedRole->id) {
          array_push($this->result, $removedRole);
          array_forget($this->removed, $rmKey);
        }
      }
      foreach ($this->parentRoles as $parentRole) {
        if($removedRole->parent_id == $parentRole->id) {
          array_push($this->result, $removedRole);
          array_forget($this->removed, $rmKey);
        }
      }
    }
  }
}

?>
