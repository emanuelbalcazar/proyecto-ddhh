<?php

use Illuminate\Database\Migrations\Migration;

class AddCriticalityAlert extends Migration {

    public function up() {
      Schema::table('alerts', function($table) {
        $table->string('criticality', 250)->nullable();
      });
    }

    public function down() {
      $table->dropColumn('criticality');
    }
}
