<?php

use App\Models\Person;

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    /**
     * The base URL to use while testing the application.
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication() {
        $app = require __DIR__.'/../bootstrap/app.php';
        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        return $app;
    }

    public function createAndGetPerson() {
        $person = new Person;

        $person->names = 'Emanuel';
        $person->surnames = 'Balcazar';
        $person->gender = 'Masculino';
        $person->birthdate = '26-06-1994';
        $person->nationality = 'Argentina';
        $person->document_number = '37730933';
        $person->document_type = 'DNI';
        $person->names_nl = 'emanuel';
        $person->names_soundex = 'E540';
        $person->surnames_nl = 'balkazar';
        $person->surnames_soundex = 'B426';
        $person->special_peculiarities = 'Cicatriz en el brazo';

        $person->save();
        return $person;
    }

}
