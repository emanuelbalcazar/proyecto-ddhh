<?php

namespace App\Services;

use DB;
use App\Models\Alert;
use App\Services\AlertResolver\AlertResolverFactory;

class AlertServiceImple extends GenericServiceImple implements AlertService {

  protected $alert;

  public function getModel() {
    return new Alert;
  }

  public function alertList(){
    return $this->alert->get();
  }

  public function accept($alert){

    //Creo el factory
    $factory = new AlertResolverFactory;
    //Obtengo la implementacion segun el tipo de alerta
    $implementation = $factory->create($alert);

    //No hay una implementacion para el tipo de alerta
    if ($implementation == null) {
      return;
    }

    //Aceptar alerta
    try {
      DB::beginTransaction();
      $implementation->accept($alert);
      DB::commit();
    } catch (Exception $e) {
      echo $e->getTraceAsString();
      error_log($e->getTraceAsString());
      DB::rollBack();
    }

  }

  public function reject($alert){

    //Creo el factory
    $factory = new AlertResolverFactory;
    //Obtengo la implementacion segun el tipo de alerta
    $implementation = $factory->create($alert);

    //No hay una implementacion para el tipo de alerta
    if ($implementation == null) {
      return;
    }

    //Aceptar alerta
    try {
      DB::beginTransaction();
      $implementation->reject($alert);
      DB::commit();
    } catch (Exception $e) {
      echo $e->getTraceAsString();
      error_log($e->getTraceAsString());
      DB::rollBack();
    }

  }

}
