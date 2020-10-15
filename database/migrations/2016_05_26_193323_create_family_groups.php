<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyGroups extends Migration {

    public function up() {

      Schema::create('family_groups_types', function (Blueprint $table) {
        $table->increments('id');
        $table->string('rol', 150)->nullable(false)->unique();
      });

      Schema::create('family_groups', function (Blueprint $table) {
        $table->increments('id');

        $table->integer('family_groups_types_id');
        $table->foreign('family_groups_types_id')->references('id')->on('family_groups_types');

        $table->integer('persons_id');
        $table->foreign('persons_id')->references('id')->on('persons');

        $table->integer('person_family_members_id');
        $table->foreign('person_family_members_id')->references('id')->on('persons');

        });

    }

    public function down() {
        Schema::drop('family_groups_types');
        Schema::drop('family_groups');
    }

}
