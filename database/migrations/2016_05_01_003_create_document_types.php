<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTypes extends Migration {

  public function up() {
    Schema::create('document_types', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name',50)->unique();
        $table->string('description', 255);
    });
  }

  public function down() {
      Schema::drop('document_types');
  }

}
