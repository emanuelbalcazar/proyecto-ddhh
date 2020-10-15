<?php

namespace App\Http\Controllers\Wrappers;

use App\Models\FamilyMember;
use App\Models\FamilyGroup;
use DB;

class FamilyMemberWrapper {

  private $familyMembers = array();

  public function __construct($request) {

    //No trajo datos de familiares
    if (!$request->input('family_members')) {
      return;
    }

    $familyMembers_json = $request->input('family_members');

    //Recorro el JSON con los familiares
    foreach ($familyMembers_json as $family) {
      //Creo una instancia del modelo
      $familyMember = new FamilyMember;
      $familyGroup = new FamilyGroup;
      $memberAndGroupsList = array();

      //Obtengo los campos del modelo
      $fields = DB::getSchemaBuilder()->getColumnListing($familyMember->getTable());

      //Compruebo que los campos del modelo esten presentes en el request
      //y se los asigno al modelo
      foreach ($fields as $name_field) {
        if (array_key_exists($name_field, $family)) {
          if($family[$name_field] == '')
          continue;
          $familyMember->$name_field = $family[$name_field];
        }
      }

      $memberAndGroupsList[0] = $familyMember;

      $familyGroup->family_groups_types_id = $family['family_groups_types_id'];
      $memberAndGroupsList[1]= $familyGroup;

      //Agrego el familiar a la lista
      $this->familyMembers[] = $memberAndGroupsList;
    }
  }

  public function familyMembers() {
    return $this->familyMembers;
  }
}
