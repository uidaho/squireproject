<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateSettingsTable extends Migration


{

    public function up()
    {


        //TODO: Impliment this to be called every time a new user is created
        Schema::create('user_settings', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unique()->key();
            $table->boolean('enable_chat')->default(1); //enabled by default

        });
    }

    public function down()
    {
        Schema::drop('user_settings');
    }
}
