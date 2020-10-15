<?php

namespace App\Services;

use App\Models\ContactDataType;
use App\Models\Town;
use App\Models\Province;
use App\Models\DocumentType;
use App\Models\Country;
use App\Models\Person;
use App\Models\FamilyGroupType;

class AdditionalInformationServiceImple implements AdditionalInformationService {

  protected $contactType;
  protected $town;
  protected $province;
  protected $documentType;
  protected $country;
  protected $person;
  protected $familyGroupType;

  public function __construct() {
    $this->contactType = new ContactDataType;
    $this->town = new Town;
    $this->province = new Province;
    $this->documentType = new DocumentType;
    $this->country = new Country;
    $this->person = new Person;
    $this->familyGroupType = new FamilyGroupType;
  }

  public function contactTypes() {
    return $this->contactType->all();
  }

  public function towns($filters) {
    return $this->town->findByFilters($filters)->get();
  }

  public function provinces($filters) {
    return $this->province->findByFilters($filters)->get();
  }

  public function documentTypes() {
    return $this->documentType->all();
  }

  public function countries($filters) {
    return $this->country->findByFilters($filters)->get();
  }

  public function contextures() {
    return ['Grande', 'Mediano', 'Pequeño'];
  }

  public function hairColors() {
    return ['Negro', 'Castaño', 'Rubio', 'Pelirrojo', 'Gris', 'Blanco'];
  }

  public function eyeColors() {
    return ['Ambar', 'Avellana', 'Azul', 'Castaño', 'Gris', 'Verde'];
  }

  public function skinColors() {
    return ['Muy clara', 'Clara', 'Medio', 'Oscura', 'Muy oscura'];
  }

  public function genders() {
    return ['Masculino', 'Femenino'];
  }

  public function kinships() {
    return $this->familyGroupType->all();
  }

  public function caseStatus() {
    return ['Abierto', 'Cerrado'];
  }

  public function caseTypes() {
    return ['Búsqueda', 'Hallazgo'];
  }

  public function names($names) {
    return $this->person->findByOnlyNames($names)->get()->unique();
  }

  public function surnames($surnames) {
    return $this->person->findByOnlySurnames($surnames)->get()->unique();
  }

}
