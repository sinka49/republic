<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListViewTable extends Migration
{
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('place_id');
            $table->integer('category_id')->unsigned()->index();
            $table->string('place_name',60);
            $table->text('place_desc');
            $table->integer('place_city')->unsigned()->index();
            $table->integer('views')->unsigned()->index();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::drop('places');
    }
}
