<?php

namespace App\Services\DataLintEngine;

use App\Models\Person;
use App\Models\PersonCase;
use App\Models\Alert;
use App\Models\Town;
use App\Models\DocumentType;
use App\Services\DataLintEngine\Translator;

/**
* Implementacion de mensaje de Dato Eliminado.
* Se genera el mensaje de alerta en caso de tener un campo en el caso
* que este vacio pero que en la persona normalizada si tenga ese campo
* con algun valor ingresado anteriormente.
*/
class DeletedDataGeneratorMessage implements GeneratorMessage {

    protected $alert;
    protected $person;
    protected $constants;
    protected $translator;

    /**
    *  Genera un mensaje de alerta si hay algun dato faltante en el caso.
    **/
    public function generatorMessage($person) {
        $this->constants = new Constants();
        $this->translator = new Translator();
        $this->person = $person;

        $this->checkPerson();
        $this->checkPersonData();
    }

    /** Revisa los datos de la persona y los transforma en caso de ser necesario */
    private function checkPerson() {
        if ($this->person->address_town_id != '') {
            $town = Town::findById($this->person->address_town_id)->get()->first();
            $this->person->address_town = $town->name;
        }

        if ($this->person->document_type_id != '') {
            $documentType = DocumentType::findById($this->person->document_type_id)->get()->first();
            $this->person->documentType = $documentType->name;
        }
    }

    /* Comprueba si la persona posee un dato faltante y genera la alerta correspondiente */
    private function checkPersonData() {
        if ($this->person->person_id) { // Si la persona tiene una foreing person_id
            $personDB = Person::findById($this->person->person_id)->get()->first();

            if ($personDB != NULL) {
                foreach ($this->constants->fields() as $key => $value) {
                    if ($this->person->$value == '' && $personDB->$value != '') {
                        $this->createAndSaveAlert($value, $personDB[$value], $personDB->id);
                    }
                }
            }
        }
    }

    /** Crea y guarda la Alerta en la Base de Datos. */
    private function createAndSaveAlert($field, $value_person, $personId) {
        $this->alert = new Alert();
        $this->alert->criticality = $this->constants->yellow();
        $this->alert->type = $this->constants->deletedData();
        $this->alert->person_id = $personId;
        $this->alert->description = $this->getDescription($field, $value_person);
        $this->alert->state = 'Pendiente';
        $this->alert->field = $field;
        $this->alert->field_translate = $this->translator->translateField($field);
        $this->alert->old_data = $value_person;
        $this->alert->save();
    }

    /** Retorna una cadena con la descripcion de la alerta */
    private function getDescription($field, $value_person) {
        $field = $this->translator->translateField($field);

        $message = "En el campo ".$field." no se ingreso
        ningun dato, pero se tiene registrado ".$value_person." de casos anteriores";
        return $message;
    }
}
