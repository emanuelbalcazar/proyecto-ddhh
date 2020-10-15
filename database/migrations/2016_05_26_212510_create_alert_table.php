<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertTable extends Migration{

  public function up() {
      Schema::create('alerts', function (Blueprint $table) {
          $table->increments('id');
          $table->string('type', 500)->nullable(false);
          $table->integer('person_case_id')->nullable(true);
          $table->string('description', 500);
          $table->boolean('state');
          $table->string('field', 500)->nullable(true);
          $table->foreign('person_case_id')->references('id')->on('person_cases');
      });
  }

  /**
  * Reverse the migrations.
  * @return void
  */
  public function down() {
      Schema::drop('alerts');
  }

}
