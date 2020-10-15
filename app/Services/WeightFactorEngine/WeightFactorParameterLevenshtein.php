<?php

namespace App\Services\WeightFactorEngine;

use App\Services\WeightFactorEngine\WeightFactorParameterGeneric;

/**
* Implmentacion de un calculador tipo Levenshtein. En dos personas distintas, comprueba
* que el campo no haya una diferencia de letras mayor a n.
*/
class WeightFactorParameterLevenshtein extends WeightFactorParameterGeneric {

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

    //Compruebo si las dos personas, en el mismo campo, no haya una diferencia mayor a 2 letras
    $value = levenshtein($person0[$field], $person1->$field);
    return ($value > -1 && $value <3);

  }

}
