<?php

use Illuminate\Database\Migrations\Migration;

class ChangeToPersonAlert extends Migration {

    public function up() {
        Schema::table('alerts', function($table) {
            $table->dropColumn('person_case_id');
            $table->integer('person_id')->nullable(true);
            $table->foreign('person_id')->references('id')->on('persons');
        });
    }

    public function down() {
        $table->dropColumn('person_id');
        $table->integer('person_case_id')->nullable(true);
        $table->foreign('person_case_id')->references('id')->on('person_cases');
    }

}
