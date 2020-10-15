<?php

use App\Models\Town;
use League\Csv\Reader;
use App\Models\DocumentType;
use App\Services\Commons\Utils;
use Illuminate\Database\Seeder;
use App\Services\PersonServiceImple;
use App\Http\Controllers\PersonController;

class Person_CaseTableSeeder extends Seeder {

    public function run() {
        // Obtengo el directorio donde se encuentra alojado el proyecto
        $basePath = base_path();
        $service = new PersonServiceImple;
        $controller = new PersonController($service);

        // Leo el CSV de personas y las creo en la DB
        $reader = Reader::createFromPath("{$basePath}/database/seeds/csv/Personas_Reales.csv");
        $reader->setDelimiter(';');
        foreach ($reader as $index => $row) {
            if ($row[11] === NULL) {
                $time = '';
            } else {
                $timeaux = strtotime($row[11]);
                $time = date('Y-m-d', $timeaux);
            }
            $time2 = strtotime($row[12]);
            $town = Town::findByName($row[10])->get()->first();
            $doc_type = DocumentType::findByName($row[4])->get()->first();

            $data = array(
                'type' => $row[0],
                'status' => $row[1],
                'nationality' => $row[3],
                'document_type_id' => $doc_type->id,
                'gender' => $row[5],
                'surnames' => $row[6],
                'names' => $row[7],
                'document_number' => Utils::normalizeDocument($row[8]),
                'age_fact' => $row[9],
                'address_town_id' => $town->id,
                'birthdate' => $time,
                'date' => date('Y-m-d', $time2),
                'place' => $row[13],
                'observations' => $row[14],
                'address_street' => $row[15]
            );
            $request = Request::create(null, null, $data);
            $controller->store($request);
        }
    }

}
