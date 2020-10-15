<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    public function run() {
        $this->call(CountriesTableSeeder::class);
        $this->call(ProvincesAndTownsTableSeeder::class);
        $this->call(ContactDataTypeTableSeeder::class);
        $this->call(DocumentTypesTableSeeder::class);
        $this->call(Person_CaseTableSeeder::class);
        $this->call(FamilyGroupTypesTableSeeder::class);
    }

}
