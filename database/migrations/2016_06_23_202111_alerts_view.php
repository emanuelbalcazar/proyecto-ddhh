<?php

use Illuminate\Database\Migrations\Migration;

class AlertsView extends Migration {

    public function up() {

      try {
        $fileContent = File::get(base_path().'/database/migrations/sql/alertView.sql');
        DB::statement($fileContent);
      } catch (Illuminate\Filesystem\FileNotFoundException $exception) {
        die('Archivo sql no encontrado :(');
      }

    }

    public function down() {
        DB::statement('DROP VIEW IF EXISTS v_alerts');
    }

}
