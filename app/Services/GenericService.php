<?php

namespace App\Services;

/**
 * Logica de negocios básica de cualquier servicio
 */
interface GenericService {

  /**
 	 * Funcion a implementar en cada servicio
 	 * @return Modelo ORM de Eloquent. Ej: El servicio de personas llamado PersonServiceImple
   * deberia devolver el modelo Person.
   */
  public function getModel();

  /**
 	 * Buscar por ID
 	 * @return
   */
  public function findById($id);

  /**
   * Buscar todas las localidades
   * @param Filtros a aplicar sobre la consulta
   * @param Página
   * @param Tamaño de la página
   */
  public function find($filters, $page, $size);

}
