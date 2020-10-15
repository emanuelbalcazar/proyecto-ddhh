<?php

namespace App\Services;

use Exception;

class ValidationException extends Exception {

  private $errors;

  public function __construct($errors) {
    $this->errors = $errors;
  }

  public function errors() {
    return $this->errors;
  }

}
