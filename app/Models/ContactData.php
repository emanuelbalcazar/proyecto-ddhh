<?php

namespace App\Models;

class ContactData extends GenericModel {

	protected $table = 'contact_data';
	public $timestamps = false;

	public function personCase() {
		return $this->belongsTo(PersonCase::class);
	}

  public function contactDataType() {
		return $this->belongsTo(ContactDataType::class);
	}

}
