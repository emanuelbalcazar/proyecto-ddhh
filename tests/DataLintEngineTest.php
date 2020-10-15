<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\PersonCase;
use App\Models\Person;

class DataLintEngineTest extends TestCase {

    protected $dataLintEngine;

    public function setUp() {
        parent::setUp();
        $this->createApplication();
        $this->dataLintEngine = $this->app->make('App\Services\DataLintEngine\DataLintEngineImple');
    }

    public function tearDown() {
        parent::tearDown();
    }

    /* Test de generacion de alertas de suficiencia de datos */
    public function testDataSufficiencyRed() {
        $personCase = PersonCase::findById(288)->get()->first();
        $personCase->names = "";
        $personCase->weight = 60;
        $personCase->contexture = "Media";
        $personCase->eye_color = "Negro";
        $personCase->person_id = 288;
        $this->dataLintEngine->dataSufficiencyGeneratorMessage($personCase);

        // $person = Person::findById(285)->get()->first();
        // $this->dataLintEngine->dataSufficiencyGeneratorMessage($person);
    }

    /* Test de generacion de alertas de nuevo dato */
    public function testNewDataGenerator() {
        $personCase = PersonCase::findById(288)->get()->first();
        $personCase->address_dept = 15;
        $personCase->person_id = 288;
        $this->dataLintEngine->newDataGeneratorMessage($personCase);
    }

    /* Test de generacion de alertas de dato modificado */
    public function testModifiedDataGenerator() {
        $personCase = PersonCase::findById(288)->get()->first();
        $personCase->person_id = 288;
        $personCase->names = "Emanuel"; // El nombre original es Eric Alberto
        $personCase->address_street = "Julian de Castro"; // La calle original es Ferrocarril Patagonico
        $this->dataLintEngine->modifiedDataGeneratorMessage($personCase);
    }

    /* Test de generacion de alertas de dato eliminado */
    public function testDeletedDataGenerator() {
        $personCase = PersonCase::findById(288)->get()->first();
        $personCase->person_id = 288;
        $personCase->names = ""; // El nombre original es Eric Alberto
        $personCase->address_street = ""; // La calle original es Ferrocarril Patagonico
        $this->dataLintEngine->deletedDataGeneratorMessage($personCase);
    }

    /* Test de generacion de alertas */
    public function testGeneratorMessage() {
        $personCase = PersonCase::findById(288)->get()->first();
        $personCase->person_id = 288;
        $personCase->names = "Emanuel"; // El nombre original es Eric Alberto
        $personCase->address_street = ""; // La calle original es Ferrocarril Patagonico
        $this->dataLintEngine->generator($personCase);
    }
}
