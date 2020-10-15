<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTowns extends Migration {

    /**
     * Run the migrations.
     * @return void
     */
    public function up() {
      Schema::create('towns', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('zip_code');
          $table->integer('province_id')->nullable(false);
      });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down() {
      Schema::drop('towns');
    }

}
