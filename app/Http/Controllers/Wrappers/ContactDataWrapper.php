<?php

namespace App\Http\Controllers\Wrappers;

use App\Models\ContactData;
use DB;

class ContactDataWrapper {

  private $contacts = array();

  public function __construct($request) {

    //No trajo datos de contacto
    if (!$request->input('contact_data')) {
      return;
    }

    $contacts_json = $request->input('contact_data');

    //Recorro el JSON con los datos de contacto
    foreach ($contacts_json as $contact) {

      //Creo una instancia del modelo
      $contactData = new ContactData;

      //Obtengo los campos del modelo
      $fields = DB::getSchemaBuilder()->getColumnListing($contactData->getTable());

      //Compruebo que los campos del modelo esten presentes en el request
      //y se los asigno al modelo
      foreach ($fields as $name_field) {
        if (array_key_exists($name_field, $contact)) {
          if($contact[$name_field] == '')
            continue;
          $contactData->$name_field = $contact[$name_field];
        }
      }

      //Agrego el familiar a la lista
      $this->contacts[] = $contactData;

    }

  }

  public function contactData() {
    return $this->contacts;
  }

}
