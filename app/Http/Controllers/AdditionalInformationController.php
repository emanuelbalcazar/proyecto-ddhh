<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Services\AdditionalInformationService;

class AdditionalInformationController extends Controller {

  protected $additionalInformationService;

  public function __construct(AdditionalInformationService $additionalInformationService) {
    $this->additionalInformationService = $additionalInformationService;
  }

  public function contactTypes() {
    return $this->additionalInformationService->contactTypes();
  }

  public function towns() {
    $filters;
    $filterableFields = ['id', 'name', 'nameList', 'zipCode', 'provinceName'];
    foreach ($filterableFields as $field) {
      if (Input::has($field)) {
        $filters ['findBy'.ucfirst($field)] = Input::get($field);
      }
    }
    return $this->additionalInformationService->towns($filters);
  }

  public function provinces() {
    $filters;
    $filterableFields = ['letter','name'];
    foreach ($filterableFields as $field) {
      if (Input::has($field)) {
        $filters ['findBy'.ucfirst($field)] = Input::get($field);
      }
    }
    return $this->additionalInformationService->provinces($filters);
  }

  public function countries() {
    $filters;
    $filterableFields = ['name'];
    foreach ($filterableFields as $field) {
      if (Input::has($field)) {
        $filters ['findBy'.ucfirst($field)] = Input::get($field);
      }
    }
    return $this->additionalInformationService->countries($filters);
  }

  public function documentTypes() {
    return $this->additionalInformationService->documentTypes();
  }

  public function contextures() {
    return $this->additionalInformationService->contextures();
  }

  public function hairColors() {
    return $this->additionalInformationService->hairColors();
  }

  public function eyeColors() {
    return $this->additionalInformationService->eyeColors();
  }

  public function skinColors() {
    return $this->additionalInformationService->skinColors();
  }

  public function genders() {
    return $this->additionalInformationService->genders();
  }

  public function kinships() {
    return $this->additionalInformationService->kinships();
  }

  public function names() {
    $names = Input::get('names');
    return $this->additionalInformationService->names($names);
  }

  public function surnames() {
    $surnames = Input::get('surnames');
    return $this->additionalInformationService->surnames($surnames);
  }

  public function caseStatus() {
    return $this->additionalInformationService->caseStatus();
  }

  public function caseTypes() {
    return $this->additionalInformationService->caseTypes();
  }

}
