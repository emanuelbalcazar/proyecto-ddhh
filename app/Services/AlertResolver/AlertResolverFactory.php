<?php

namespace App\Services\AlertResolver;

use App\Services\AlertResolver\NewDataAlertResolver;

/**
* A partir del tipo de alerta crea una implementacion que la puede resolver.
*/
class AlertResolverFactory {

  public function create($alert) {
    switch ($alert->type) {
      case 'Nuevo Dato':
        return new NewDataAlertResolver;
      case 'Datos Insuficientes':
        return new InsufficientDataAlertResolver;
      default:
        return null;
    }
  }

}
