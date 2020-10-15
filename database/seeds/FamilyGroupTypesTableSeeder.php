<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;

class FamilyGroupTypesTableSeeder extends Seeder{

    public function run(){
      // Obtengo el directorio donde se encuentra alojado el proyecto
      $basePath = base_path();

      // Leo el CSV de provincias y las creo en la DB
      $reader = Reader::createFromPath("{$basePath}/database/seeds/csv/family_rol.csv");
      $reader->setDelimiter(';');
      foreach ($reader as $index => $row) {
          DB::table('family_groups_types')->insert(
          array(
            'rol' => $row[0]
          ));
      }
    }
}
