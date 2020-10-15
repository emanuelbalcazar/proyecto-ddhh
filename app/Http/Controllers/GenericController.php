<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

abstract class GenericController extends Controller {

  /**
   * Campos por los que se puede filtrar
   */
  abstract public function getValidFilterableFields();

  /**
   * Servicio
   */
  abstract public function getService();

  public function index() {

    $filters = null;
    $page = null;
    $pageSize = null;

    foreach ($this->getValidFilterableFields() as $field) {
      error_log($field);
      if (Input::has($field)) {
         $filters ['findBy'.ucfirst($field)] = Input::get($field);
      }
    }

    //Opcional
    if (Input::has('page'))
      $page = Input::get('page');

    //Opcional
    if (Input::has('pageSize'))
      $pageSize = Input::get('pageSize');

    return $this->getService()->find($filters, $page, $pageSize);

  }

}
