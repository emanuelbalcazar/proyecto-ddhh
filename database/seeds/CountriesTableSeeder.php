<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use App\Models\Country;

class CountriesTableSeeder extends Seeder {

    public function run() {
      //Obtengo el directorio donde se encuentra alojado el proyecto
      $basePath = base_path();

      //Leo el CSV de personas y las creo en la DB
      $reader = Reader::createFromPath("{$basePath}/database/seeds/csv/countries.csv");
      $reader->setDelimiter(';');
      foreach ($reader as $index => $row) {
        DB::table('countries')->insert(
        array(
          'name' => $row[0],
          'name_esp' => $row[1],
          'name_eng' => $row[2],
          'iso2' => $row[3],
          'iso3' => $row[4],
          'phone_code' => $row[5]
        ));
      }
    }

}
