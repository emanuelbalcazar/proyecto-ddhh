<?php

namespace App\Services;

interface AlertService extends GenericService {

  public function alertList();

  /**
  * Aceptar una alerta
  */
  public function accept($alert);

  /**
  * Rechazar una alerta
  */
  public function reject($alert);

}
