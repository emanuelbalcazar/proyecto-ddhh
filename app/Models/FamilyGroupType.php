<?php

namespace App\Models;

class FamilyGroupType extends GenericModel {

  protected $table = 'family_groups_types';
  public $timestamps = false;

  public function getTable() {
		return 'family_groups_types';
	}

}
