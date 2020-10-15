<?php

use Illuminate\Database\Migrations\Migration;

class UptdateTableAlert extends Migration {

  public function up() {
    Schema::table('alerts', function($table) {
      $table->string('state', 250)->change();
    });
  }

  public function down() {
    $table->boolean('state')->change();
  }

}
