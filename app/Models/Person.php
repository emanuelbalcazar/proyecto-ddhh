<?php

namespace App\Models;

use App\Services\Commons\Utils;
use DB;

class Person extends GenericModel {

  protected $table = 'persons';
  public $timestamps = false;

  public function getTable() {
    return 'persons';
  }

  public function group(){
    return $this->hasMany(FamilyGroup::Class);
  }

  public function scopeFindById($query, $id) {
    return $query->where('id', '=', $id);
  }

  public function scopeFindByOnlyNames($query, $names) {
    return $query->where('names', 'ILIKE', '%'.$names.'%')->select('names');
  }

  public function scopeFindByOnlySurnames($query, $surnames) {
    return $query->where('surnames', 'ILIKE', '%'.$surnames.'%')->select('surnames');
  }

  public function scopeFindByPersonNames($query, $names) {
    return $query->orWhere('names_nl', 'ILIKE', '%'.Utils::normalize($names).'%')
                  ->orWhere(DB::raw('soundexesp(names_nl)'), '=', Utils::soundexEsp($names))
                  ->orWhere(DB::raw('levenshtein(names_nl,\''.Utils::normalize($names).'\')'), '<', 3);
  }

  public function scopeFindByPersonSurnames($query, $surnames) {
    return $query->orWhere('surnames_nl', 'ILIKE', '%'.Utils::normalize($surnames).'%')
                  ->orWhere(DB::raw('soundexesp(surnames_nl)'), '=', Utils::soundexEsp($surnames))
                  ->orWhere(DB::raw('levenshtein(surnames_nl,\''.Utils::normalize($surnames).'\')'), '<', 3);
  }

  public function scopeFindByDocumentNumber($query, $number) {
    return $query->orWhere('document_number', '=', Utils::normalizeDocument($number));
  }

  public function scopeFindByPersonBirthdateYear($query, $year) {
    return $query->orWhere(DB::raw('EXTRACT(YEAR from birthdate)'), '=', $year);
  }

  public function scopeFindByPersonBirthdateMonth($query, $month) {
    return $query->orWhere(DB::raw('EXTRACT(MONTH from birthdate)'), '=', $month);
  }

  public function scopeFindByPersonBirthdateDay($query, $day) {
    return $query->orWhere(DB::raw('EXTRACT(DAY from birthdate)'), '=', $day);
  }

  public function scopeGetNamesById($query, $id){
    return $query->where('id', '=', $id)->select('names', 'surnames');
  }

}
