<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdditionalInformationControllerTest extends TestCase {

  public function testNames() {
    $this->call('GET','additional_information/names/?names=eric');
    $this->assertResponseOk();
  }

  public function testSurnames() {
    $this->call('GET','additional_information/surnames/?surnames=hidalgo');
    $this->assertResponseOk();
  }

}
