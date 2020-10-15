<?php

namespace App\Services\WeightFactorEngine;

use App\Services\WeightFactorEngine\WeightFactorParameterGeneric;

/**
* Implmentacion de un calculador básico. En dos personas distintas, comprueba
* que el campo sea del mismo tipo y contenga el mismo valor.
*/
class WeightFactorParameterSimple extends WeightFactorParameterGeneric {

  /**
  * Verifica si el factor es aplicable a la persona
  * @param person $person0 Primera persona.
  * @param person $person1 Segunda persona.
  * @return boolean $apply true si aplica, false caso contrario
  */
  public function check($person0, $person1) {

    $field = $this->field;

    if (!array_key_exists($field, $person0) || $person1[$field] == '' || $person1->$field == '')
      return false;

    //Compruebo si las dos personas, en el mismo campo, contiene el valor
    return (strtoupper($person0[$field]) === strtoupper($person1->$field));

  }

}
