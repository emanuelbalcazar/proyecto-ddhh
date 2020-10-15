<?php

namespace App\Services;

use DB;
use App\Models\Person;
use App\Models\VPerson;
use App\Models\PersonCase;
use App\Models\FamilyGroup;
use App\Models\Document;
use App\Services\PersonWrapper;
use App\Services\ValidationException;
use App\Services\WeightFactorEngine\WeightEngine;
use App\Services\DataLintEngine\DataLintEngineImple;

/** Implementación de la logica de negocios relacionada con Personas */
class PersonServiceImple extends GenericServiceImple implements PersonService {

    public function getModel() {
        return new VPerson;
    }

    public function create($personCase, $contactData, $familyMembers) {

        $personWrapper = new PersonWrapper();
        $familyGroupWrapper = new PersonWrapper();
        $linter = new DataLintEngineImple();

        DB::beginTransaction();
        try {

            // Guardo caso de la persona
            $personCase->save();

            // Guardo datos de contacto de la persona
            if ($contactData) {
                foreach ($contactData as $element) {
                    $element->person_case_id = $personCase->id;
                    $element->save();
                }
            }

            // Guardo los miembros de la familia
            if ($familyMembers) {
                foreach ($familyMembers as $familyAndGroup) {

                    $familyMember = $familyAndGroup[0];
                    $familyGroup = $familyAndGroup[1];

                    //Guardo family_members correspondiente al caso
                    $familyMember->person_case_id = $personCase->id;
                    $familyMember->save();

                    //Guardo family member como persona
                    $personFamilyMemberWrapper = new PersonWrapper();
                    $personFamilyMemberWrapper->generatorbyFamilyMember($familyMember);
                    $personFamilyMemberWrapper->person()->save();
                    $familyGroup->person_family_members_id = $personFamilyMemberWrapper->person()->id;

                    $linter->dataSufficiencyGeneratorMessage($personFamilyMemberWrapper->person());
                }
            }

            // Guardo a la persona plana
            if ($personCase->person_id == null || $personCase->person_id == '') {
                $personWrapper->generatorbyPersonCase($personCase);
                $personWrapper->person()->save();

                // Le asigno el id de la persona plana al person case
                PersonCase::insertPersonId($personCase->id, $personWrapper->person()->id);

                // Relacionando la persona del caso con los familiares(persona)
                if ($familyMembers) {
                    foreach ($familyMembers as $familyAndGroup) {
                        $familyGroup = $familyAndGroup[1];
                        $familyGroup->persons_id =  $personWrapper->person()->id;
                        $familyGroup->save();
                    }
                }
            $linter->generator($personCase);

            } else {
            // Le asigno el id de la persona plana al person case
            $linter->generator($personCase);
            } // FIN de guardar persona plana

            DB::commit();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
            error_log($e->getTraceAsString());
            DB::rollBack();
        }
    }

    /**
    * Busca personas similares, agregando el porcentaje de similitud
    * @param Filtros a aplicar sobre la consulta
    */
    public function matching($filters) {
        $result = $this->getModel()->findByFilters($filters)->get();
        if (count($result) > 50) { // TODO: Configurable plz
            return array();
        }
        $weightEngine = new WeightEngine;
        $weightEngine->build();
        $person0 = array();
        $day='00';
        $month='00';
        $year='9999';
        $filterByBirthdate = false;
        foreach ($filters as $filterName => $filterValue) {
            if ($filterName == 'findByPersonNames' && $filterValue != '') {
                $person0['names'] = $filterValue;
            }
            if ($filterName == 'findByPersonSurnames' && $filterValue != '') {
                $person0['surnames'] = $filterValue;
            }
            if ($filterName == 'findByDocumentNumber' && $filterValue != '') {
                $person0['document_number'] = $filterValue;
            }
            if ($filterName == 'findByPersonBirthdateYear' && $filterValue != '') {
                $year = $filterValue;
                $filterByBirthdate = true;
            }
            if ($filterName == 'findByPersonBirthdateMonth' && $filterValue != '') {
                $month = $filterValue;
                $filterByBirthdate = true;
            }
            if ($filterName == 'findByPersonBirthdateDay' && $filterValue != '') {
                $day = $filterValue;
                $filterByBirthdate = true;
            }
        }
        if ($filterByBirthdate) {
            $birthdate = $year.'-'.$month.'-'.$day;
            $person0['birthdate'] = $birthdate;
        }
        foreach ($result as $key => $person1) {
            $person1->weight = $weightEngine->calculatePercentage($person0, $person1);
            if ($person1->weight == 0) {
                unset($result[$key]);
            }
        }
        return $result;
    }

      public function getNamesById($id){
        return $this->getModel()->getNamesById($id)->get()->first();
      }

}
