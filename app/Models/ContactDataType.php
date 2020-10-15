<?php

namespace App\Models;

class ContactDataType extends GenericModel {

	protected $table = 'contact_data_types';
	public $timestamps = false;

	public function getTable() {
		return 'contact_data_types';
	}

	public function scopeFindById($query, $id) {
		return $query->where('id', '=', $id);
	}

	public function contact() {
		return $this->belongsTo(ContactData::class);
	}

	public function scopeFindByName($query, $name) {
		return $query->where('name', 'ILIKE', '%'.$name.'%');
	}

}
