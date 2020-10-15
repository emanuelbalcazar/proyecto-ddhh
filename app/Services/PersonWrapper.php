<?php

namespace App\Services;

use DB;
use App\Models\Town;
use App\Models\Person;
use App\Models\Province;
use App\Models\DocumentType;
use App\Models\ContactDataType;
use App\Services\Commons\Utils;
use App\Services\FamilyGroup;
use App\Models\FamilyGroupType;

class PersonWrapper {

    private $person;

    public function generatorbyPersonCase($personCase) {

        $this->person = new Person;
        $fields = DB::getSchemaBuilder()->getColumnListing($this->person->getTable());

        foreach ($fields as $name_field) {

            //Ignorar id
            if ($name_field == 'id') {
                continue;
            }

            //Ignorar datos de contacto
            if (strpos($name_field, 'contact_data_') !== false) {
                continue;
            }

            //Ignorar datos de familiares
            if (strpos($name_field, 'family_members_') !== false) {
                continue;
            }

            if ($name_field === 'names_nl' || $name_field === 'names_soundex') {
                continue;
            }

            if ($name_field === 'surnames_nl' || $name_field === 'surnames_soundex') {
                continue;
            }

            if ($name_field === 'address_street_nl' || $name_field === 'address_street_soundex') {
                continue;
            }

            //Si el campo es nombre, aplicar normalizaciones
            if ($name_field === 'names') {
                $this->person->names_nl = Utils::normalize($personCase->names);
                $this->person->names_soundex = Utils::soundexEsp($personCase->names);
            }

            //Si el campo es apellido, aplicar normalizaciones
            if ($name_field === 'surnames') {
                $this->person->surnames_nl = Utils::normalize($personCase->surnames);
                $this->person->surnames_soundex = Utils::soundexEsp($personCase->surnames);
            }

            //Si el campo es la calle del domicilio, aplicar normalizaciones
            if ($name_field === 'address_street') {
                $this->person->address_street_nl = Utils::normalize($personCase->address_street);
                $this->person->address_street_soundex = Utils::soundexEsp($personCase->address_street);
            }

            if ($name_field == 'address_town') {
                $town = Town::findById($personCase->address_town_id)->get()->first();
                if ($town) {
                    $this->person->address_town =  $town->name;
                }
                continue;
            }

            if ($name_field == 'document_type') {
                $documentType = DocumentType::findById($personCase->document_type_id)->get()->first();
                if ($documentType) {
                    $this->person->document_type = $documentType->name;
                }
                continue;
            }

            $this->person->$name_field = $personCase[$name_field];
        }
        //Datos de contacto
        $contactData = $personCase->contactData()->get();
    }

    public function generatorbyFamilyMember($familyMember){

        $this->person = new Person;
        $fields = DB::getSchemaBuilder()->getColumnListing($this->person->getTable());

        foreach ($fields as $name_field) {
            //Ignorar id
            if ($name_field == 'id') {
                continue;
            }

            if ($name_field === 'names_nl' || $name_field === 'names_soundex') {
                continue;
            }

            if ($name_field === 'surnames_nl' || $name_field === 'surnames_soundex') {
                continue;
            }

            if ($name_field === 'address_street_nl' || $name_field === 'address_street_soundex') {
                continue;
            }

            //Si el campo es nombre, aplicar normalizaciones
            if ($name_field === 'names') {
                $this->person->names_nl = Utils::normalize($familyMember->names);
                $this->person->names_soundex = Utils::soundexEsp($familyMember->names);
            }

            //Si el campo es apellido, aplicar normalizaciones
            if ($name_field === 'surnames') {
                $this->person->surnames_nl = Utils::normalize($familyMember->surnames);
                $this->person->surnames_soundex = Utils::soundexEsp($familyMember->surnames);
            }

            //Si el campo es la calle del domicilio, aplicar normalizaciones
            if ($name_field === 'address_street') {
                $this->person->address_street_nl = Utils::normalize($familyMember->address_street);
                $this->person->address_street_soundex = Utils::soundexEsp($familyMember->address_street);
            }

            if ($name_field == 'address_town') {
                $town = Town::findById($familyMember->address_town_id)->get()->first();
                if ($town) {
                    $this->person->address_town =  $town->name;
                }
                continue;
            }

            if ($name_field == 'document_type') {
                $documentType = DocumentType::findById($familyMember->document_type_id)->get()->first();
                if ($documentType) {
                    $this->person->document_type = $documentType->name;
                }
                continue;
            }
            $this->person->$name_field = $familyMember[$name_field];
        }

    }

    public function person() {
        return $this->person;
    }

}
