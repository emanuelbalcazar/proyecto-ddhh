<?php

namespace App\Http\Controllers\Wrappers;

use App\Http\Controllers\StorageController;
use App\Models\PersonCase;
use Validator;
use DB;

class PersonCaseWrapper {

    private $personCase;

    public function __construct($request) {

        //Creo una instancia del modelo
        $this->personCase = new PersonCase;

        //Obtengo los campos del modelo
        $fields = DB::getSchemaBuilder()->getColumnListing($this->personCase->getTable());

        //Compruebo que los campos del modelo esten presentes en el request
        //y se los asigno al modelo
        foreach ($fields as $name_field) {
            if (array_key_exists($name_field, $request->all())) {
                if($request->input($name_field) == '')
                continue;
                $this->personCase->$name_field = $request->input($name_field);
            }
        }
        $photo = $request['photo'];
        $storage = new StorageController($photo);
        $name_photo = $storage->getNamePhoto();
        $this->personCase->photo = $name_photo;
    }

    public function personCase() {
        return $this->personCase;
    }

}
