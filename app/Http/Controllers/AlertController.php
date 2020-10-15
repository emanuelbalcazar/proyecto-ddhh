<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Services\AlertService;
use App\Http\Controllers\Wrappers\AlertWrapper;

class AlertController extends GenericController {

  protected $alertService;

  public function __construct(AlertService $alertService) {
    $this->alertService = $alertService;
  }

  /** Campos por los que se puede filtrar */
  public function getValidFilterableFields() {
    return ['personId'];
  }

  /** Servicio */
  public function getService() {
    return $this->alertService;
  }

  public function alerList() {
    $person_id = Input::get('personId');
    return $this->alertService->alertList($person_id);
  }

  public function accept(Request $request) {
    $alertWrapper = new AlertWrapper($request);
    return $this->alertService->accept($alertWrapper->alert());
  }

  public function reject(Request $request) {
    $alertWrapper = new AlertWrapper($request);
    return $this->alertService->reject($alertWrapper->alert());
  }

}
