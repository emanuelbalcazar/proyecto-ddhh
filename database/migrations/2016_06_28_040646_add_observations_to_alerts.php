<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddObservationsToAlerts extends Migration {

  public function up() {
    Schema::table('alerts', function($table) {
      $table->string('observations', 500)->nullable(true);
    });
  }

  public function down() {
    Schema::table('alerts', function($table) {
      $table->dropColumn('observations');
    });
  }

}
