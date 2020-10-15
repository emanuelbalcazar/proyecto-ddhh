<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvinces extends Migration {

    /**
     * Run the migrations.
     * @return void
     */
    public function up() {
      Schema::create('provinces', function (Blueprint $table) {
          $table->increments('id');
          $table->string('letter')->unique();
          $table->string('iso3166_2')->unique();
          $table->string('name');
      });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down() {
        Schema::drop('provinces');
    }

}
