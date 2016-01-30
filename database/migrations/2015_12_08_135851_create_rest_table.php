<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestTable extends Migration
{

    public function up()
    {
        Schema::create('rest', function (Blueprint $table) {
        $table->increments('rest_id');
        $table->string('rest_type',60);
        });
    }


    public function down()
    {
        Schema::drop('rest');
    }
}
