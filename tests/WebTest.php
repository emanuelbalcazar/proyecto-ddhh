<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WebTest extends TestCase {

    public function testReadWeb() {
        $this->visit('/')->see('DDHH');
    }

}
