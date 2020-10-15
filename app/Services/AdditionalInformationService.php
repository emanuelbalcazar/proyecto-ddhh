<?php

namespace App\Services;

interface AdditionalInformationService {

  public function contactTypes();

  public function towns($filters);

  public function provinces($filters);

  public function countries($filters);

  public function documentTypes();

  public function contextures();

  public function hairColors();

  public function eyeColors();

  public function skinColors();

  public function genders();

  public function kinships();

  public function names($names);

  public function surnames($surnames);

  public function caseStatus();

  public function caseTypes();

}
