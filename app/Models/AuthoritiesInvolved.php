<?php

namespace App\Models;

class AuthoritiesInvolved extends GenericModel {

	protected $table = 'authorities_involved';
	public $timestamps = false;

  public function personCase() {
    return $this->belongsTo(PersonCase::class);
  }

}
