<?php

namespace App\Services\WeightFactorEngine;

use League\Csv\Reader;
use ReflectionClass;

/** Motor que construye los factores de ponderacion configurados y permite ponderar dos personas */
class WeightEngine {

  //Lista de factores
  protected $factors = array();

  /** Construir los factores de ponderacion configurados */
  public function build() {

    //Obtengo el directorio donde se encuentra alojado el proyecto
    $basePath = base_path();

    //Obtengo los factores configurados
    $reader = Reader::createFromPath("{$basePath}/app/Services/WeightFactorEngine/config/factors.csv");
    $reader->setDelimiter(',');

    $first = true;
    foreach ($reader as $index => $row) {

      //Ignora la cabecera del CSV
      if ($first) {
        $first = false;
        continue;
      }

      //Trato de encontrar el factor en la lista existente
      $weightFactor = $this->getFactor($row[0]);
      //Si no lo encuentro, lo creo y lo agrego
      if (!$weightFactor) {
        $weightFactor = new WeightFactor;
        $weightFactor->setName($row[0]);
        $weightFactor->setWeight($row[1]);
        $this->factors[] = $weightFactor;
      }

      //Creo el parametro del factor y lo agrego al mismo
      $reflection = new ReflectionClass("App\Services\WeightFactorEngine\\".$row[3]);
      $weightFactorParameter = $reflection->newInstanceWithoutConstructor();
      $weightFactorParameter->setField($row[2]);
      $weightFactor->addFactorParameter($weightFactorParameter);
    }
  }

  /**
  * Verifica si el factor es aplicable a la persona y retorna el peso correspondiente
  * @param person $person0 Primera persona.
  * @param person $person1 Segunda persona.
  * @return int $weight Peso
  */
  public function calculate($person0, $person1) {
    $totalWeight = $this->getTotalWeight();
    foreach ($this->factors as $factor) {
      $totalWeight = $totalWeight - $factor->calculate($person0, $person1);
    }
    return $totalWeight;
  }

  /**
  * Verifica si el factor es aplicable a la persona y retorna un procentaje de coincidencia
  * @param person $person0 Primera persona.
  * @param person $person1 Segunda persona.
  * @return string $percentage Porcentaje de coincidencia
  */
  public function calculatePercentage($person0, $person1) {

    $weight = $this->calculate($person0, $person1);
    $totalWeight = $this->getTotalWeight();

    $percent = 0;
    if ($totalWeight > 0) {
      $percent = $weight/$totalWeight;
    }
    return number_format($percent * 100, 0);
  }

  /**
  * Obtiene el peso total de todos los factores de ponderación
  * @return int $weight Peso total
  */
  private function getTotalWeight() {
    $weight = 0;
    foreach ($this->factors as $factor) {
      $weight = $weight + $factor->getWeight();
    }
    return $weight;
  }

  /**
  * Busca entre la lista de factores ya creados y lo retorna
  * @return weightFactor $weightFactor Factor de poderacion
  */
  private function getFactor($name) {
    foreach ($this->factors as $factor) {
      if ($factor->getName()  == $name)
      return $factor;
    }
    return null;
  }

}
