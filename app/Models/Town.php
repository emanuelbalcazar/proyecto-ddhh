<?php

namespace App\Models;

class Town extends GenericModel {

	protected $table = 'towns';
	public $timestamps = false;

	public function province() {
		return $this->belongsTo(Province::class);
	}

	public function scopeFindById($query, $id) {
		return $query->where('id', '=', $id);
	}

	public function scopeFindByNameList($query, $nameList) {
		foreach(explode(',', $nameList) as $name) {
    	$query->orWhere('name', 'ILIKE', '%'.$name.'%');
		}
		return $query->distinct()->select(array('id', 'name'))->get();
	}

	public function scopeFindByName($query, $name) {
		return $query->where('name', 'ILIKE', '%'.$name.'%');
	}

	public function scopeFindByZipCode($query, $zipCode) {
		return $query->where('zip_code', 'ILIKE', $zipCode);
	}

	public function scopeFindByProvinceId($query, $provinceId) {
		return $query->where('province_id', '=', $provinceId);
	}

	public function scopeFindByProvinceName($query, $provinceName) {
		return $query
						->join('provinces', 'towns.province_id', '=', 'provinces.id')
						->select('towns.*')
						->where('provinces.name', 'ILIKE', '%'.$provinceName.'%');
	}

}
