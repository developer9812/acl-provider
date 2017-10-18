<?php

namespace App\Helpers;

class RoleFlatMap {

  private $role;
  private $result = [];

  public function __construct($role)
  {
    $this->role = $role;
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
    return $result;
  }

  public function flatten($role)
  {
    array_push( $this->result, $role );
    if ( is_iterable( $role->children ) ) {
      foreach ( $role->children as $child ) {
        $this->flatten($child);
      }
    }
  }
}

 ?>
