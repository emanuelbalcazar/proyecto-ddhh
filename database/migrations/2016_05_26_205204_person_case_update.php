<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PersonCaseUpdate extends Migration {

    public function up() {
      Schema::create('person_cases', function (Blueprint $table) {

        //Datos del caso
        $table->increments('id');
        $table->string('type', 50)->nullable(false);
        $table->string('status', 50)->nullable(false);
        $table->string('reason', 800)->nullable(true);
        $table->string('place', 800)->nullable(true);
        $table->date('date');

        //Datos de persona
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
        $table->integer('address_town_id')->nullable(true);
        $table->foreign('address_town_id')->references('id')->on('towns');

        //Documento
        $table->string('document_number', 50)->nullable(true);
        $table->integer('document_type_id')->nullable(true);
        $table->foreign('document_type_id')->references('id')->on('document_types');

        //Caracteristicas / Datos biometricos
        $table->double('height', 1, 2)->nullable(true);
        $table->string('contexture', 50)->nullable(true);
        $table->string('hair_color', 50)->nullable(true);
        $table->string('skin_color', 50)->nullable(true);
        $table->string('eye_color', 50)->nullable(true);
        $table->string('clothing', 800)->nullable(true);
        $table->string('special_peculiarities', 800)->nullable(true)->change();
        $table->string('photo')->nullable(true);
        $table->integer('age_fact')->nullable(true);
        $table->float('weight')->nullable(true);

        $table->integer('person_id')->nullable(true);
        $table->foreign('person_id')->references('id')->on('persons');


      });

    }

    public function down() {
      Schema::drop('person_cases');

    }
}
