<?php

namespace App\Services\AlertResolver;

use App\Models\Person;
use App\Models\Alert;
use App\Services\AlertResolver\AlertResolver;

/**
* Implementacion para resolver alertas del tipo "Nuevo dato".
*/
class NewDataAlertResolver implements AlertResolver {

    public function accept($alert) {

      //Actualizo la alerta
      $alertDB = Alert::find($alert->id);
      $alertDB->state = "Aceptada";
      $alertDB->observations = $alert->observations;
      $alertDB->save();

    }

    public function reject($alert) {

      //Busco la persona relacionada a la alerta y remover el dato
      $field = str_replace(' ', '_', $alert->field);
      $personDB = Person::find($alert->person_id);
      $personDB->$field = null;
      $personDB->save();

      //Actualizo la alerta
      $alertDB = Alert::find($alert->id);
      $alertDB->state = "Rechazada";
      $alertDB->observations = $alert->observations;
      $alertDB->save();

    }

}
