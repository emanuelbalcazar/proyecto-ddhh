<?php

use App\Services\WeightFactorEngine\WeightEngine;

class WeightEngineTest extends TestCase {

  public function testExample() {
    $we = new WeightEngine;
    $we->build();
    $this->assertTrue(true);
  }

}
