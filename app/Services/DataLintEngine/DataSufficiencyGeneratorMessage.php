<?php

namespace App\Services\DataLintEngine;
use App\Models\Alert;
use App\Services\DataLintEngine\Translator;
use App\Services\DataLintEngine\Constants;
use App\Models\PersonCase;

/**
* Implementacion de Suficiencia de Datos.
*
* Se genera el mensaje de alerta ROJA en caso de no tener uno de los 3 datos minimos
* (nombre, apellido, fecha de nacimiento y documento).
* Se genera el mensaje de alerta AMARILLA en caso de no tener algun dato basico y/o familiares.
* Se genera el mensaje de alerta VERDE en caso de tener datos biometricos y/o contactos.
*/
class DataSufficiencyGeneratorMessage implements GeneratorMessage {

    protected $alert;
    protected $person;
    protected $id;
    protected $constants;
    protected $translator;

    /**
    *  Genera un mensaje de alerta segun a la cantidad de datos registrados en la persona.
    *  TODO - Limpiar la cocina.
    **/
    public function generatorMessage($person) {
        $this->constants = new Constants();
        $this->translator = new Translator();
        $this->person = $person;

        $this->checkPerson();
        $this->checkMinimumData();
        $this->checkBasicData();
        $this->checkBiometricData();
    }

    /* Revisa los datos de la persona y los transforma en caso de ser necesario */
    private function checkPerson() {        
        if ($this->person->document_type_id)
            $this->person->document_type = $this->person->document_type_id;

        if ($this->person->address_town_id)
            $this->person->address_town = $this->person->address_town_id;

        if ($this->person->person_id) // Si la persona tiene una foreing person_id
            $this->id = $this->person->person_id;
        else
            $this->id = $this->person->id;
    }

    /* Comprueba si la persona posee los datos minimos y genera la alerta correspondiente */
    private function checkMinimumData() {
        foreach ($this->constants->minimumData() as $key => $value) {
            if ($this->person[$value] == '') {
                $this->createAndSaveAlert($this->constants->red(), $value, $this->id);
            }
        }
    }

    /* Comprueba si la persona posee los datos basicos y genera la alerta correspondiente */
    private function checkBasicData() {
        foreach ($this->constants->basicData() as $key => $value) {
            if ($this->person[$value] == '') {
                $this->createAndSaveAlert($this->constants->yellow(), $value, $this->id);
            }
        }
    }

    /* Comprueba si la persona posee los datos biometricos y genera la alerta correspondiente */
    private function checkBiometricData() {
        foreach ($this->constants->biometricData() as $key => $value) {
            if ($this->person[$value] == '') {
                $this->createAndSaveAlert($this->constants->green(), $value, $this->id);
            }
        }
    }

    /* Guarda la alerta en la base de datos llamando al modelo de Eloquent */
    private function createAndSaveAlert($criticality, $field, $personId) {
        $this->alert = new Alert();
        $this->alert->type = $this->constants->dataSufficiency();
        $this->alert->criticality = $criticality;
        $this->alert->field = $field;
        $this->alert->field_translate = $this->translator->translateField($field);
        $this->alert->person_id = $personId;
        $this->alert->description = $this->getDescription($criticality, $field);
        $this->alert->state = 'Pendiente';
        $this->alert->save();
    }

    /* Retorna una cadena con la descripcion de la alerta */
    private function getDescription($criticality, $field) {
        $field = $this->translator->translateField($field);
        switch ($criticality) {
            case $this->constants->red():
                return "No posee el dato minimo requerido ".$field;
            case $this->constants->yellow():
                return "No posee el dato basico requerido ".$field;
            case $this->constants->green():
                return "No posee el dato biometrico requerido ".$field;
            default:
                return "Alerta Desconocida";
        }
    }
}
