<?php

namespace App\Services;

/**
* Logica de negocios relacionada con Personas
*/
interface PersonService extends GenericService {

  public function create($personCase, $contactData, $familyMembers);

  /**
   * Busca personas similares, agregando el porcentaje de similitud
   * @param Filtros a aplicar sobre la consulta
   */
  public function matching($filters);

  public function getNamesById($id);
}
