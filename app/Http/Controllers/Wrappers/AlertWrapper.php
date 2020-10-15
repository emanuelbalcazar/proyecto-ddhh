<?php

namespace App\Http\Controllers\Wrappers;

use App\Models\Alert;
use DB;

class AlertWrapper {

  private $alert;

  public function __construct($request) {

    $this->alert = new Alert;
    $fields = DB::getSchemaBuilder()->getColumnListing($this->alert->getTable());

    foreach ($fields as $name_field) {
      $this->alert->$name_field = $request->input($name_field);
    }

  }

  public function alert() {
    return $this->alert;
  }

}
