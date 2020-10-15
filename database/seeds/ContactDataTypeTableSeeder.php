<?php

use Illuminate\Database\Seeder;
use App\Models\ContactDataType;

class ContactDataTypeTableSeeder extends Seeder {

  public function run() {

    ContactDataType::create(array(
      'type' => 'Email'
    ));

    ContactDataType::create(array(
      'type' => 'Telefono'
    ));

    ContactDataType::create(array(
      'type' => 'Red Social'
    ));

    ContactDataType::create(array(
      'type' => 'Otro'
    ));

  }

}
