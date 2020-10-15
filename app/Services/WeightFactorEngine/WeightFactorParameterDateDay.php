<?php

namespace App\Services\WeightFactorEngine;

use App\Services\WeightFactorEngine\WeightFactorParameterGeneric;

/**
* Implementacion de un calculador para el dia de una fecha.
* En dos personas distintas, comprueba que el dia de la fecha
* contenga el mismo valor.
*/
class WeightFactorParameterDateDay extends WeightFactorParameterGeneric {

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

    $person1_time = strtotime(str_replace('/', '-', $person1->$field));

    //Extraigo los campos de la fecha de las dos personas
    $person0_value = explode("-", $person0[$field])[2];
    $person1_value = date("j", $person1_time);

    //Compruebo si para las dos personas, en el mismo campo, contiene el mismo valor
    return ($person0_value == $person1_value);

  }

}
