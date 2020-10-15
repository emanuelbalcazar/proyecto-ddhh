<?php

namespace App\Models;

class Province extends GenericModel {

	protected $table = 'provinces';
	public $timestamps = false;

	public function scopeFindById($query, $id) {
		return $query->where('id', '=', $id);
	}

	public function scopeFindByLetter($query, $letter) {
		return $query->where('letter', '=', $letter);
	}

	public function scopeFindByName($query, $name) {
		return $query->where('name', 'ILIKE', '%'.$name.'%');
	}

}
