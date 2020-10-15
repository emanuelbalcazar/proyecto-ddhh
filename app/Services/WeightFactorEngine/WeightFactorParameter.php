<?php

namespace App\Services\WeightFactorEngine;

/**
* Parametro de un factor de ponderación
*/
interface WeightFactorParameter {

  /**
  * Asignar campo
  * @param string $field Campo de la persona. Ej: document_number
  */
  public function setField($field);

  /**
  * Verifica si el factor es aplicable a la persona
  * @param person $person0 Primera persona.
  * @param person $person1 Segunda persona.
  * @return boolean $apply true si aplica, false caso contrario
  */
  public function check($person0, $person1) ;

}
