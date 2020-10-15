<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Province;

/**
 * Test para Provincia
 */
class ProvinceTest extends TestCase {

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
 	 * Test para probar la búsqueda por letra
 	 * @return void
	 */
  public function testFindByLetter() {

    $province = new Province;
    $province->name = 'Provincia de prueba';
    $province->letter = 'PP';
    $province->iso3166_2 = 'AR-PP';
    $province->save();

    $provinceDB = Province::findByLetter('PP')->get()->first();

    $this->assertTrue($provinceDB->letter === 'PP');

  }

  /**
   * Test para probar la búsqueda por nombre
   * @return void
   */
  public function testFindByName() {

    $province = new Province;
    $province->name = 'Provincia de prueba';
    $province->letter = 'PP';
    $province->iso3166_2 = 'AR-PP';
    $province->save();

    $provinceDB = Province::findByName('Provincia de prueba')->get()->first();

    $this->assertTrue($provinceDB->name === 'Provincia de prueba');

  }

}
