<?php

namespace App\Services\AlertResolver;

/**
* Solucionador de alertas
*/
interface AlertResolver {

  /*
  * Funcion a implementar que acepta la alerta
  */
  public function accept($alert);

  /*
  * Funcion a implementar que rechaza la alerta
  */
  public function reject($alert);

}
