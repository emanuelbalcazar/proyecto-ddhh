<?php

namespace App\Services;

use ReflectionMethod;
use App\Services\Paginator;

abstract class GenericServiceImple implements GenericService {

  /**
 	 * Se debe implementar en cada servicio
 	 * @return Modelo ORM de Eloquent
	 */
  abstract public function getModel();

  /**
 	 * Buscar por ID
 	 * @return
   */
  public function findById($id) {
    return $this->getModel()->findById($id)->get()->first();
  }

  /**
   * Buscar todas las localidades
   * @param Filtros a aplicar sobre la consulta
   * @param Página
   * @param Tamaño de la página
   */
  public function find($filters, $page, $pageSize) {

    $query = $this->getModel()->findByFilters($filters);
    $total = $this->getModel()->findByFilters($filters)->count();

    if ($page != null && $pageSize != null) {
      if ($page == 0)
        $query->take($pageSize);
      else
        $query->skip($page*$pageSize)->take($pageSize);
    }

    return new Paginator($page, $pageSize, $total, $query->get());
  }

}
