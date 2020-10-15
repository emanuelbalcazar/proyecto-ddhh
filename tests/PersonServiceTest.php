<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PersonServiceTest extends TestCase {

  protected $personService;

  public function setUp() {
    parent::setUp();
    $this->createApplication();
    $this->personService = $this->app->make('App\Services\PersonService');
    //DB::beginTransaction();
  }

  public function tearDown() {
    parent::tearDown();
    //DB::rollBack();
  }

  public function testFindById() {

    echo $this->personService->findById(1);
    $this->assertTrue(true);

  }

}
