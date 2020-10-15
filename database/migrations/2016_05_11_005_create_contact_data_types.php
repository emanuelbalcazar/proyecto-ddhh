<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactDataTypes extends Migration {

  /**
   * Run the migrations.
   * @return void
   */
  public function up() {
    Schema::create('contact_data_types', function (Blueprint $table) {
      $table->increments('id');
      $table->string('type', 50)->nullable(false)->unique();
    });
  }

  /**
   * Reverse the migrations.
   * @return void
   */
  public function down() {
      Schema::drop('contact_data_types');
  }

}
