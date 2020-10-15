<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactData extends Migration {

  public function up() {
    Schema::create('contact_data', function (Blueprint $table) {
      $table->increments('id');
      $table->string('value', 250)->nullable(false);
      $table->integer('person_case_id')->nullable(false);
      $table->integer('contact_data_type_id')->nullable(false);
      $table->foreign('person_case_id')->references('id')->on('person_cases');
      $table->foreign('contact_data_type_id')->references('id')->on('contact_data_types');
    });
  }

  /**
  * Reverse the migrations.
  * @return void
  */
  public function down() {
    Schema::drop('contact_data');
  }

}
