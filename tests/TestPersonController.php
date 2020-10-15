<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\PersonCase;

class TestPersonController extends TestCase {

  public function setUp() {
    parent::setUp();
    $this->createApplication();
    DB::beginTransaction();
  }

  public function tearDown() {
    parent::tearDown();
    DB::commit();
    // DB::rollBack();
  }

  // public function testStore() {
  //
  //   $person = array();
  //   $contactData = array();
  //   $familyMembers = array();
  //
  //   $person["person_names"] = "Eric";
  //   $person["person_surnames"] = "Hidalgo";
  //   $person["person_gender"] = "";
  //   $person["person_birthdate"] = "";
  //   $person["person_nationality"] = "";
  //   $person["person_observations"] = "";
  //   $person["address_street"] = "";
  //   $person["address_number"] = "";
  //   $person["address_floor"] = "";
  //   $person["address_dept"] = "";
  //   $person["address_town_id"] = "";
  //   $person["document_number"] = "";
  //   $person["document_type_id"] = "";

  //   $person["height"] = "";
  //   $person["weight"] = "";
  //   $person["contexture"] = "";
  //   $person["hair_color"] = "";
  //   $person["skin_color"] = "";
  //   $person["eye_color"] = "";
  //   $person["clothing"] = "";
  //   $person["special_peculiarities"] = "";
  //
  //   // Datos del caso
  //   $person["type"] = "Busqueda";
  //   $person["status"] = "Abierto";
  //   $person["reason"] = "";
  //   $person["place"] = "";
  //   $person["date"] = "18/05/2016";
  //   $person["age_fact"] = "";
  //   $person["recidivist"] = true;
  //
  //   $this->post('persons/store', $person)->seeJson();
  //
  //   $this->assertTrue(true);
  // }

  public function testStore() {

    $person = array();
    $contactData = array();
    $familyMembers = array();

    $person["names"] = "Kevin";
    $person["surnames"] = "Chucho";
    $person["gender"] = "";
    $person["birthdate"] = "18/05/2016";

    // Datos del caso
    $person["type"] = "Busqueda";
    $person["status"] = "Abierto";
    $person["reason"] = "";
    $person["place"] = "";
    $person["date"] = "09/06/2016";
    $person["age_fact"] = "";

    // print_r ($person);
    $this->json('POST', 'persons/store', $person)->seeJson();

    $this->assertTrue(true);
  }

  public function testContacData() {

    $person = array();
    $contactDatas = array();
    $familyMembers = array();

    $person["names"] = "Kevin";
    $person["surnames"] = "Chucho";
    $person["gender"] = "";
    $person["birthdate"] = "18/05/2016";

    // Datos del caso
    $person["type"] = "Busqueda";
    $person["status"] = "Abierto";
    $person["reason"] = "";
    $person["place"] = "";
    $person["date"] = "09/06/2016";
    $person["age_fact"] = "";

    $contactData = array();

    $contactData["value"] = "Esto es una prueba del contact data tipo na";
    $contactData["contact_data_type_id"] = "3";


    $contactDatas[]=$contactData;
    $person["contact_data"] = $contactDatas;

    $this->json('POST', 'persons/store', $person)->seeJson();

    $this->assertTrue(true);
  }

  public function testFamily() {

    $person = array();
    $contactData = array();
    $familyMembers = array();

    $person["names"] = "Agusto";
    $person["surnames"] = "Musse";
    $person["gender"] = "";
    $person["birthdate"] = "14/03/1991";

    // Datos del caso
    $person["type"] = "Busqueda";
    $person["status"] = "Abierto";
    $person["reason"] = "";
    $person["place"] = "";
    $person["date"] = "2016-06-3";
    $person["age_fact"] = "";


    $familyMember = array();
    // Datos del Familiares
    $familyMember["names"]="Edgardo";
    $familyMember["surnames"]="Musse";
    $familyMember["phones"]="";
    $familyMember["birthdate"]="14/01/1954";
    $familyMember["document_number"]="";
    $familyMember["document_type"]="";
    $familyMember["complainant"]="true";
    $familyMember["complainant_date"]="06/06/2016";
    $familyMember["address_street"]="";
    $familyMember["address_number"]="";
    $familyMember["address_floor"]="";
    $familyMember["address_dept"]="";
    $familyMember["address_town_id"]="";
    $familyMember["family_groups_types_id"]="1";

    $familyMembers[]=$familyMember;
    $person["family_members"] = $familyMembers;
    // $cualquiernombre = json_encode($person);
    // print($cualquiernombre);
    $this->json('POST', 'persons/store', $person)->seeJson();
    // $this->json('POST', 'family_members/store', $familyMembers)->seeJson();

    $this->assertTrue(true);
  }

}
