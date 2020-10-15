<?php

namespace App\Services\DataLintEngine;

class Translator {

    /** Kill me please */
    public function translateField($field) {

        switch ($field) {
            case 'names':
                return 'Nombre';
            case 'surnames':
                return 'Apellido';
            case 'birthdate':
                return 'Fecha de Nacimiento';
            case 'nationality':
                return 'Nacionalidad';
            case 'gender':
                return 'Genero';
            case 'observations':
                return 'Observaciones';
            case 'address_street':
                return 'Calle';
            case 'address_number':
                return 'Numero de calle';
            case 'address_floor':
                return 'Piso';
            case 'address_dept':
                return 'Departamento';
            case 'address_town':
                return 'Localidad';
            case 'address_town_id':
                return 'Localidad';
            case 'document_number':
                return 'Numero de documento';
            case 'document_type':
                return 'Tipo de documento';
            case 'document_type_id':
                return 'Tipo de documento';
            case 'heigth':
                return 'Altura';
            case 'contexture':
                return 'Contextura';
            case 'hair_color':
                return 'Color de cabello';
            case 'skin_color':
                return 'Color de tez';
            case 'eye_color':
                return 'Color de ojos';
            case 'clothing':
                return 'Vestimenta';
            case 'weight':
                return 'Peso';
            case 'special_peculiarities':
                return "Señas particulares";
            case 'age_fact':
                return "Edad al momento del hecho";
            case 'family_members':
                return "Familiares";
            case 'photo':
                return "Foto";
            case 'contact_data':
                return "Contacto";
            case 'kin':
                return "Parentesco";
        }
    }

}
