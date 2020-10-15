<?php

namespace App\Models;

class DocumentType extends GenericModel {

	protected $table = 'document_types';
	public $timestamps = false;

	public function scopeFindById($query, $id) {
		return $query->where('id', '=', $id);
	}

	public function scopeFindByName($query, $name) {
		return $query->where('name', 'ILIKE', '%'.$name.'%');
	}

}
