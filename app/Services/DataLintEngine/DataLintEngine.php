<?php

namespace App\Services\DataLintEngine;

interface DataLintEngine {

    /*
    * Funcion a implementar del Generador de alertas
    */
    public function generator($person);

}
