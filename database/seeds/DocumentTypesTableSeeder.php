<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;

class DocumentTypesTableSeeder extends Seeder {

    public function run() {

      // Obtengo el directorio donde se encuentra alojado el proyecto
      $basePath = base_path();

      // Leo el CSV de provincias y las creo en la DB
      $reader = Reader::createFromPath("{$basePath}/database/seeds/csv/document_types.csv");
      $reader->setDelimiter(';');
      foreach ($reader as $index => $row) {
          DB::table('document_types')->insert(
          array(
            'name' => $row[0],
            'description' => $row[1],
          ));
      }
    }

}
