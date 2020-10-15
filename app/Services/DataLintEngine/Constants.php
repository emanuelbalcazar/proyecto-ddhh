<?php

namespace App\Services\DataLintEngine;

class Constants {

    protected $min = array('names', 'surnames', 'birthdate', 'document_number', 'document_type');

    protected $basic = array('gender', 'nationality', 'address_street',
    'address_number', 'address_floor','address_dept', 'address_town', 'photo');

    protected $biometric = array('heigth', 'contexture', 'hair_color', 'skin_color', 'eye_color',
    'clothing', 'weight', 'special_peculiarities');

    protected $fields = array('names', 'surnames', 'birthdate', 'gender', 'nationality', 'observations',
    'address_street','address_number', 'address_floor','address_dept','address_town', 'document_number',
    'document_type', 'heigth', 'contexture', 'hair_color', 'skin_color', 'eye_color',
    'clothing', 'weight', 'special_peculiarities');

    // protected $familyData = array('kin', 'document_type', 'document_number', 'address_town_id', 'address_street',
    // 'address_number', 'address_floor', 'address_dept');

    public function red() {
        return "ROJO";
    }

    public function yellow() {
        return "AMARILLO";
    }

    public function green() {
        return "VERDE";
    }

    public function minimumData() {
        return $this->min;
    }

    public function basicData() {
        return $this->basic;
    }

    public function biometricData() {
        return $this->biometric;
    }

    public function familyData() {
        return $this->familyData;
    }

    public function fields() {
        return $this->fields;
    }

    public function dataSufficiency() {
        return "Datos Insuficientes";
    }

    public function deletedData() {
        return "Dato Eliminado";
    }

    public function modifiedData() {
        return "Dato Modificado";
    }

    public function newData() {
        return "Nuevo Dato";
    }

}
