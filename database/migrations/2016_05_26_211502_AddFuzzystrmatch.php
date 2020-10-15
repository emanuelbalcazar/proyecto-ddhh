<?php

use Illuminate\Database\Migrations\Migration;

class AddFuzzystrmatch extends Migration {

    public function up() {
        DB::statement('CREATE EXTENSION fuzzystrmatch');
    }

    public function down() { }

}
