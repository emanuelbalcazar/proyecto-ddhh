<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountry extends Migration {

    /**
     * Run the migrations.
     * @return void
     */
    public function up() {
      Schema::create('countries', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('name_esp');
          $table->string('name_eng');
          $table->string('iso2');
          $table->string('iso3');
          $table->integer('phone_code');
      });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down() {
        Schema::drop('countries');
    }
}
