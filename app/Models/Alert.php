<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Alert extends GenericModel {
    protected $table = 'alerts';
    public $timestamps = false;

  public function getTable(){
    return 'alerts';
  }

  public function person() {
    return $this->belongsTo(PersonCase::class);
  }

  public function scopeInsertAlert($query, $type, $description, $personCaseId) {
    DB::table('alerts')->insert(
    array(
      'type' => $type,
      'description' => $description,
      'person_case_id' => $personCaseId,
      'state' => 'Pendiente'
    ));
  }

  public function scopeFindByPersonId($query, $person_id){
    return $query->where('person_id', '=', $person_id);
  }
}
