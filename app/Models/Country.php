<?php

namespace App\Models;

class Country extends GenericModel {

  protected $table = 'countries';
  public $timestamps = false;

  public function scopeFindByName($query, $name) {
    return $query->where('name', 'ILIKE', '%'.$name.'%');
  }

}
