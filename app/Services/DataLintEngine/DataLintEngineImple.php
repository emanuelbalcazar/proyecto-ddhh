<?php

namespace App\Services\DataLintEngine;

use App\Services\DataLintEngine\DataSufficiencyGeneratorMessage;
use App\Services\DataLintEngine\NewDataGeneratorMessage;


/**
* Implementacion del Linter de Persona
* Se encarga de delegar la persona a cada generador de mensaje para obtener
* las alertas correspondientes.
*/
class DataLintEngineImple implements DataLintEngine {

    protected $implementations = array();
    protected $interfaceName = 'GeneratorMessage';

    public function generator($person) {
        $this->implementations[] = new NewDataGeneratorMessage();
        $this->implementations[] = new ModifiedDataGeneratorMessage();
        $this->implementations[] = new DeletedDataGeneratorMessage();
        $this->implementations[] = new DataSufficiencyGeneratorMessage();

        foreach ($this->implementations as $key => $generator) {
                $generator->generatorMessage($person);
        }
    }

    public function dataSufficiencyGeneratorMessage($person) {
        $generator = new DataSufficiencyGeneratorMessage();
        $generator->generatorMessage($person);
    }

    public function newDataGeneratorMessage($person) {
        $generator = new NewDataGeneratorMessage();
        $generator->generatorMessage($person);
    }

    public function modifiedDataGeneratorMessage($person) {
        $generator = new ModifiedDataGeneratorMessage();
        $generator->generatorMessage($person);
    }

    public function deletedDataGeneratorMessage($person) {
        $generator = new DeletedDataGeneratorMessage();
        $generator->generatorMessage($person);
    }

}
