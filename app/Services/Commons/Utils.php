<?php

namespace App\Services\Commons;

use DB;

class Utils {

  /**
  * Normaliza un string.
  * @param string $str Texto a normalizar.
  * @return string normalizado.
  */
  public static function normalize($str) {
    setlocale(LC_CTYPE, 'es_ES');

    $result = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
    $result = preg_replace('/[-_\.]+|\s+/', ' ', $result); // Reemplaza guion, punto y guion bajo por espacio.
    $result = preg_replace('/[^\w\s]+/', '', $result); // Quita cualquier cosa que no sea letra.
    $result = preg_replace('/(.)\1+/', '$1', $result); // Reemplaza caracteres repetidos por 1 solo.
    $result = preg_replace('/(qu|ck|q)/', 'k', $result);
    $result = preg_replace('/(ci|ce|x|s)/', 'z', $result);
    $result = preg_replace('/(ca)/', 'ka', $result);
    $result = preg_replace('/(co)/', 'ko', $result);
    $result = preg_replace('/(cu)/', 'ku', $result);
    $result = preg_replace('/v/', 'b', $result);
    $result = preg_replace('/y/', 'i', $result);
    $result = preg_replace('/h/', '', $result);
    $result = strtolower(trim($result));
    return $result;
  }

  /**
  * Normaliza un string para devolver un documento valido.
  * NOTA: No admite pasaporte ya que quita letras.
  * @param string $str Texto a normalizar.
  * @return string normalizado.
  */
  public static function normalizeDocument($str) {
    if (!$str) {
      return null;
    }
    return preg_replace('/\D+/', '', $str); // Quita cualquier cosa que no sea digito.
  }

  /**
  * Devuelve el valor generado con una funcion en la DB de soundex en español.
  * @param string texto a analizar con soundex.
  * @return string el valor del soundex para esa palabra.
  */
  public static function soundexEsp($str) {
    $str_nl = self::normalize($str);
    return DB::select("SELECT soundexesp('".$str_nl."')")[0]->soundexesp;
  }

  /**
  * Devuelve la cantidad de operaciones a realizar para llegar del str1 al str2.
  * @param str1 string de origen.
  * @param str2 string de destino.
  * @return integer con la diferencia de caracteres entre los strings.
  */
  public static function levenshtein($str1, $str2) {
    return DB::select("SELECT levenshtein('".$str1."','".$str2."')")[0]->levenshtein;
  }

}
