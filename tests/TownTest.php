<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Town;
use App\Models\Province;

/** Test para Localidad */
class TownTest extends TestCase {

  public function setUp() {
     parent::setUp();
     $this->createApplication();
     DB::beginTransaction();
  }

  public function tearDown() {
     parent::tearDown();
     DB::rollBack();
  }

  /**
   * Test para probar la búsqueda por nombre
   * @return void
   */
  public function testFindByName() {
    $province = Province::findByName('CHUBUT')->get()->first();
    $town = new Town;
    $town->name = 'Localidad de prueba';
    $town->zip_code = '0001';
    $town->province_id = $province->id;
    $town->save();
    $townDB = Town::findByName('Localidad de prueba')->get()->first();
    $this->assertTrue($townDB->name === 'Localidad de prueba');
  }

  /**
   * Test para probar la búsqueda por código postal
   * @return void
   */
  public function testFindByZipCode() {
    $province = Province::findByName('CHUBUT')->get()->first();
    $town = new Town;
    $town->name = 'Localidad de prueba';
    $town->zip_code = '0001';
    $town->province_id = $province->id;
    $town->save();
    $townDB = Town::findByZipCode('0001')->get()->first();
    $this->assertTrue($townDB->zip_code === '0001');
  }

  /**
   * Test para probar la búsqueda por nombre de provincia
   * @return void
   */
  public function testFindByProvinceName() {
    $townDB = Town::findByProvinceName('CHUBUT')->get()->first();
    $this->assertTrue($townDB->province->name === 'CHUBUT');
  }

}
