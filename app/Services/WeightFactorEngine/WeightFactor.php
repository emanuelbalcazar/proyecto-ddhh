<?php

namespace App\Services\WeightFactorEngine;

/** Implementacion basica del factor de ponderación */
class WeightFactor {

  protected $name;
  protected $weight;
  protected $parameters = array();

  /**
  * Asignar el nombre del factor de ponderación
  * @param string $name Nombre. Ej: Factor1
  */
  public function setName($name) {
    $this->name = $name;
  }

  /**
  * Retorna el nombre del factor de ponderación
  * @return string $name Nombre
  */
  public function getName() {
    return $this->name;
  }

  /**
  * Asignar el peso del factor
  * @param int $weight Peso. Ej: 500
  */
  public function setWeight($weight) {
    $this->weight = $weight;
  }

  /**
  * Retorna el peso
  * @param int $weight Peso
  */
  public function getWeight() {
    return $this->weight;
  }

  /**
  * Agregar parametro
  * @param WeightFactorParameter $factorParameter Parametro.
  */
  public function addFactorParameter($factorParameter) {
    $this->parameters[] = $factorParameter;
  }

  /**
  * Verifica si el factor es aplicable a la persona y retorna el peso correspondiente
  * @param person $person0 Primera persona.
  * @param person $person1 Segunda persona.
  * @return int $weight Peso
  */
  public function calculate($person0, $person1) {
    foreach ($this->parameters as $factorParameter) {
      if ($factorParameter->check($person0, $person1)) {
        return 0;
      }
    }
    return $this->weight;
  }

}
