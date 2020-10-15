<?php

use Illuminate\Database\Migrations\Migration;

class AddDataInAlertTable extends Migration {

    public function up() {
        Schema::table('alerts', function($table) {
          $table->string('new_data', 250)->nullable();
          $table->string('old_data', 250)->nullable();
        });
    }

    public function down() {
        Schema::table('alerts', function($table) {
          $table->dropColumn('new_data');
          $table->dropColumn('old_data');
        });
    }

}
