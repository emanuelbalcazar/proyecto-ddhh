<?php

namespace App\Services\WeightFactorEngine;

use App\Services\WeightFactorEngine\WeightFactorParameter;

/**
* Implementacion asbtracta de un calculador generico.
* No tiene implementada la funcion check.
*/
abstract class WeightFactorParameterGeneric implements WeightFactorParameter {

  protected $field;

  /**
  * Asignar campo
  * @param string $field Campo de la persona. Ej: document_number
  */
  public function setField($field) {
    $this->field = $field;
  }

  /**
  * Verifica si el factor es aplicable a la persona
  * @param person $person0 Primera persona.
  * @param person $person1 Segunda persona.
  * @return boolean $apply true si aplica, false caso contrario
  */
  abstract public function check($person0, $person1);

}
