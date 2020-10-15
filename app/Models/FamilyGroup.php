<?php

namespace App\Models;

class FamilyGroup extends GenericModel {

    protected $table = 'family_groups';
    public $timestamps = false;

    public function getTable() {
  		return 'family_groups';
  	}

    public function person(){
      return $this->hasMany(Person::Class);
    }

    public function familyMember(){
      return $this->belongsTo(Person::Class);
    }

}
