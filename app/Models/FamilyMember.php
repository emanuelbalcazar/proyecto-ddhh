<?php

namespace App\Models;

class FamilyMember extends GenericModel {

	protected $table = 'family_members';
	public $timestamps = false;

	public function getTable() {
		return 'family_members';
	}

	public function personCase() {
		return $this->belongsTo(PersonCase::class);
	}

	public function town() {
    return $this->belongsTo(Town::class);
  }

}
