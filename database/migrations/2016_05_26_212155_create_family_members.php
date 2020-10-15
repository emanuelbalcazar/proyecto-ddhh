<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyMembers extends Migration {

  public function up() {
    Schema::create('family_members', function (Blueprint $table) {
      $table->increments('id');
      $table->string('names', 250)->nullable(true);
      $table->string('surnames', 250)->nullable(true);
      $table->string('phones', 250)->nullable(true);
      $table->string('kin', 250)->nullable(true);
      $table->boolean('complainant')->nullable(true);
      $table->date('complainant_date')->nullable(true);
      $table->date('birthdate')->nullable(true);
      $table->string('document_number', 50)->nullable(true);
      $table->string('document_type')->nullable(true);
      $table->string('address_street', 50)->nullable(true);
      $table->integer('address_number')->nullable(true);
      $table->integer('address_floor')->nullable(true);
      $table->string('address_dept', 10)->nullable(true);
      $table->integer('address_town_id')->nullable(true);
      $table->foreign('address_town_id')->references('id')->on('towns');
      $table->integer('person_case_id')->nullable(false);
      $table->foreign('person_case_id')->references('id')->on('person_cases');
    });
  }

  /**
   * Reverse the migrations.
   * @return void
   */
  public function down() {
      Schema::drop('family_members');
  }

}
