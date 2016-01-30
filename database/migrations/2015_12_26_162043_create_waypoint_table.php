<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaypointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waypoint', function (Blueprint $table) {
            $table->increments('point_id');
            $table->integer('place_id')->unsigned()->index();
            $table->float('point_latitude')->unsigned()->index();
            $table->float('point_longitude')->unsigned()->index();
            $table->integer('point_number')->unsigned()->index();
            $table->string('point_caption',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('waypoint');
    }
}
