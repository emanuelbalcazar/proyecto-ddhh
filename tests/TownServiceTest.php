<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TownServiceTest extends TestCase {

  protected $townService;

  public function setUp() {
    parent::setUp();
    $this->createApplication();
    $this->townService = $this->app->make('App\Services\TownService');
  }

  public function tearDown() {
    parent::tearDown();
  }

  /** Test para probar la búsqueda por nombre */
  public function testFindByName() {
    $this->assertTrue($this->townService->findByName('ESQUEL')->first()->name === 'ESQUEL');
  }

}
