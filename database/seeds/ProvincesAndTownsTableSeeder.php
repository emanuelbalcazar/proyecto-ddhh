<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use App\Models\Province;

class ProvincesAndTownsTableSeeder extends Seeder {

    /** Crear provincias y localidades de Chubut */
    public function run() {

      // Obtengo el directorio donde se encuentra alojado el proyecto
      $basePath = base_path();

      // Leo el CSV de provincias y las creo en la DB
      $reader = Reader::createFromPath("{$basePath}/database/seeds/csv/provinces.csv");
      $reader->setDelimiter(';');
      foreach ($reader as $index => $row) {
          DB::table('provinces')->insert(
          array(
            'letter' => $row[0],
            'iso3166_2' => $row[1],
            'name' => $row[2]
          ));
      }

      // Obtengo la provincia del Chubut
      $province = Province::findByLetter('U')->get()->first();

      // Leo el CSV de localidades del Chubut y las creo en la DB
      $reader = Reader::createFromPath("{$basePath}/database/seeds/csv/towns.csv");
      $reader->setDelimiter(';');
      foreach ($reader as $index => $row) {
          DB::table('towns')->insert(
          array(
            'name' => $row[2],
            'zip_code' => $row[0],
            'province_id' => $province->id
          ));
      }
    }

}
