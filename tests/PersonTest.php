<?php

use App\Models\Person;

class PersonTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $this->createApplication();
        DB::beginTransaction();
    }

    public function tearDown() {
        parent::tearDown();
        DB::rollBack();
    }

    public function testFindByPersonNames() {
        $person = $this->createAndGetPerson();
        $data = Person::findByPersonNames('Emanuel')->get()->first();
        $this->assertTrue($data->names === 'Emanuel');
    }

    public function testFindByPersonSurnames() {
        $person = $this->createAndGetPerson();
        $data = Person::findByPersonSurnames('Balcazar')->get()->first();
        $this->assertTrue($data->surnames === 'Balcazar');
    }

    public function testFindByDocumentNumber() {
        $person = $this->createAndGetPerson();
        $data = Person::findByDocumentNumber('dni 37730933')->get()->first();
        $this->assertTrue($data->document_number === '37730933');
    }

    public function testFindByPersonBirthdateYear() {
        $person = $this->createAndGetPerson();
        $data = Person::findByPersonBirthdateYear('1994')->get()->first();
        $this->assertTrue($data->birthdate === '1994-06-26');
    }

    public function testFindByPersonBirthdateMonth() {
        $person = $this->createAndGetPerson();
        $data = Person::findByPersonBirthdateMonth('06')->findByPersonBirthdateYear('1994')->get()->first();
        $this->assertTrue($data->birthdate === '1994-06-26');
    }

    public function testFindByPersonBirthdateDay() {
        $person = $this->createAndGetPerson();
        $data = Person::findByPersonBirthdateDay('26')->get()->first();
        $this->assertTrue($data->birthdate === '1994-06-26');
    }

}
