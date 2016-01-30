<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relation_rest_and_places', function (Blueprint $table) {
            $table->increments('relation_id');
            $table->integer('place_id')->unsigned()->index();
            $table->integer('rest_id')->unsigned()->index();
        });
        Schema::create('relations_places_and_catforapp', function (Blueprint $table) {
            $table->increments('relation_id');
            $table->integer('place_id')->unsigned()->index();
            $table->integer('cat_for_app_id')->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('relation_rest_and_places');
        Schema::drop('relations_places_and_catforapp');
    }
}
