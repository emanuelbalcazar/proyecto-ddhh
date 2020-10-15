<?php

use App\Services\Commons\Utils;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Normalizations extends TestCase {

    /** Test de funciones de normalizacion. */
    public function testUtilsNormalization() {

      $orig = "ordinez";
      echo "\tOriginal: ".$orig;
      echo "\t-\tResultado: ".Utils::normalize($orig)."\t-\tsoundex: ".Utils::soundexEsp($orig)."\t-\tlevenshtein: ".Utils::levenshtein($orig, Utils::normalize($orig))."\n";

      $orig = "ordínez";
      echo "\tOriginal: ".$orig;
      echo "\t-\tResultado: ".Utils::normalize($orig)."\t-\tsoundex: ".Utils::soundexEsp($orig)."\t-\tlevenshtein: ".Utils::levenshtein($orig, Utils::normalize($orig))."\n";

      $orig = "hordinez";
      echo "\tOriginal: ".$orig;
      echo "\t-\tResultado: ".Utils::normalize($orig)."\t-\tsoundex: ".Utils::soundexEsp($orig)."\t-\tlevenshtein: ".Utils::levenshtein($orig, Utils::normalize($orig))."\n";

      $orig = "ordines";
      echo "\tOriginal: ".$orig;
      echo "\t-\tResultado: ".Utils::normalize($orig)."\t-\tsoundex: ".Utils::soundexEsp($orig)."\t-\tlevenshtein: ".Utils::levenshtein($orig, Utils::normalize($orig))."\n";

      $orig = "ordynez";
      echo "\tOriginal: ".$orig;
      echo "\t-\tResultado: ".Utils::normalize($orig)."\t-\tsoundex: ".Utils::soundexEsp($orig)."\t-\tlevenshtein: ".Utils::levenshtein($orig, Utils::normalize($orig))."\n";

      $orig = "ordiñez";
      echo "\tOriginal: ".$orig;
      echo "\t-\tResultado: ".Utils::normalize($orig)."\t-\tsoundex: ".Utils::soundexEsp($orig)."\t-\tlevenshtein: ".Utils::levenshtein($orig, Utils::normalize($orig))."\n";

      $orig = "hordyñes";
      echo "\tOriginal: ".$orig;
      echo "\t-\tResultado: ".Utils::normalize($orig)."\t-\tsoundex: ".Utils::soundexEsp($orig)."\t-\tlevenshtein: ".Utils::levenshtein($orig, Utils::normalize($orig))."\n";

      $this->assertTrue(true);
    }

    /** Test de soundexEsp directo desde la base. */
    public function testUtilsSoundexEsp() {
      // echo "\n\n.Soundex =\t\t\t";
      // $orig = "mexico";
      // echo "Original: ".$orig;
      // echo "\t-\tResultado: ".Utils::soundexEsp($orig);
      // $this->assertTrue(true);
    }

}
