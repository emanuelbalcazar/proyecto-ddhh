<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class GenericModel extends Model {

	public function scopeFindByFilters($query, $filters) {

		if (!$filters)
			return $query;

		//Recorre todos los filtros. $key es el metodo que deberia estar
    //implementado en el modelo y $value el valor del filtro a aplicar
		foreach($filters as $key=>$value) {

      $methodName = 'scope'.ucwords($key);

      //Verifico si el metodo existe
			if (method_exists($this, $methodName)) {
        //Anido las consultas
				$query->$key($value);
      } else {
				error_log('no existe '.$methodName);
			}
    }

		return $query;
	}

}
