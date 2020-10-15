<?php

use Illuminate\Database\Migrations\Migration;

class SoundexEsp extends Migration {

    /**
     * Run the migrations.
     * @return void
     */
    public function up() {

      try {
        $fileContent = File::get(base_path().'/database/migrations/sql/soundexEsp.sql');
        DB::statement($fileContent);
      } catch (Illuminate\Filesystem\FileNotFoundException $exception) {
        die('Archivo sql no encontrado :(');
      }

    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down() {
      DB::statement('DROP FUNCTION IF EXISTS soundexesp(text)');
    }

}
