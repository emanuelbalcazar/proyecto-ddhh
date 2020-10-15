<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PersonTableRefactor extends Migration {

    public function up() {
      Schema::create('persons', function (Blueprint $table) {

          //Datos de persona
          $table->increments('id');
          $table->string('names', 250)->nullable(true);
          $table->string('surnames', 250)->nullable(true);
          $table->string('gender', 50)->nullable(true);
          $table->date('birthdate')->nullable(true);
          $table->string('nationality', 50)->nullable(true);
          $table->string('observations', 800)->nullable(true);
          //Domicilio
          $table->string('address_street', 250)->nullable(true);
          $table->integer('address_number')->nullable(true);
          $table->integer('address_floor')->nullable(true);
          $table->string('address_dept', 10)->nullable(true);
          $table->string('address_town')->nullable(true);
          //Documento
          $table->string('document_number', 50)->nullable(true);
          $table->string('document_type')->nullable(true);
          //Columnas Kevin
          $table->string('names_nl', 250)->nullable(true);
          $table->string('names_soundex', 250)->nullable(true);
          $table->string('surnames_nl', 250)->nullable(true);
          $table->string('surnames_soundex', 250)->nullable(true);
          $table->string('address_street_nl', 250)->nullable(true);
          $table->string('address_street_soundex', 250)->nullable(true);

      });
    }

    public function down() {
        Schema::drop('persons');
    }

}
