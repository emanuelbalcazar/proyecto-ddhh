<?php

use Illuminate\Database\Migrations\Migration;

class AddBiometricDataPerson extends Migration {

    public function up() {

        Schema::table('persons', function($table) {

          //Datos biometricos de persona
          $table->double('height', 1, 2)->nullable(true);
          $table->string('contexture', 50)->nullable(true);
          $table->string('hair_color', 50)->nullable(true);
          $table->string('skin_color', 50)->nullable(true);
          $table->string('eye_color', 50)->nullable(true);
          $table->string('clothing', 800)->nullable(true);
          $table->string('special_peculiarities', 800)->nullable(true);
          $table->integer('age_fact')->nullable(true);
          $table->float('weight')->nullable(true);
      });
    }

    public function down() {
        Schema::drop('persons');
    }

}
