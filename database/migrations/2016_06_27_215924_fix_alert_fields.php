<?php

use Illuminate\Database\Migrations\Migration;

class FixAlertFields extends Migration {

  public function up() {
    Schema::table('alerts', function($table) {
      $table->renameColumn('field', 'field_translate');
    });
    Schema::table('alerts', function($table) {
      $table->string('field', 500)->nullable(true);
    });
  }

  public function down() {
    Schema::table('alerts', function($table) {
      $table->dropColumn('field');
    });
    Schema::table('alerts', function($table) {
      $table->renameColumn('field_translate', 'field');
    });
  }
}
