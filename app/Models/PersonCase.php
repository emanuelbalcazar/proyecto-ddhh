<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class PersonCase extends GenericModel {

    protected $table = 'person_cases';
    public $timestamps = false;

    public function getTable() {
        return 'person_cases';
    }

    public function town() {
        return $this->belongsTo(Town::class);
    }

    public function person() {
        return $this->belongsTo(Person::Class);
    }

    public function contactData() {
        return $this->hasMany(ContactData::class);
    }

    public function familyMembers() {
        return $this->hasMany(FamilyMember::class);
    }

    public function authoritiesInvolved() {
        return $this->hasMany(AuthoritiesInvolved::class);
    }

    public function alerts() {
        return $this->hasMany(Alert::class);
    }

    public function scopeFindById($query, $id) {
        return $query->where('id', '=', $id);
    }

    public function scopeFindByCaseType($query, $caseType) {
        return $query->where('type', '=', $caseType);
    }

    public function scopeFindByName($query, $name) {
        return $query->where('name', 'ILIKE', '%'.$name.'%');
    }

    public function scopeFindBySurname($query, $surname) {
        return $query->where('surname', 'ILIKE', '%'.$surname.'%');
    }

    public function scopeFindByGender($query, $gender) {
        return $query->where('gender', '=', $gender);
    }

    public function scopeInsertPersonId($query, $personCaseId, $personId) {
        DB::table('person_cases')->where('id', $personCaseId)->update(['person_id' => $personId]);
    }

}
