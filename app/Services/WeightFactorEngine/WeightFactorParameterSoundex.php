<?php

namespace App\Services\WeightFactorEngine;

use App\Services\WeightFactorEngine\WeightFactorParameterGeneric;

/**
* Implmentacion de un calculador tipo Soundex. En dos personas distintas, comprueba
* que el campo sea contengan un valor similar utilizando el algoritmo de Soundex.
*/
class WeightFactorParameterSoundex extends WeightFactorParameterGeneric {

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

    //Compruebo si las dos personas, en el mismo campo, contiene el mismo codigo soundex
    return (soundex($person0[$field]) == soundex($person1->$field));

  }

}
