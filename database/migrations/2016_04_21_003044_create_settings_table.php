<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

<<<<<<< HEAD
class CreateSettingsTable extends Migration
=======
class CreateUserSettingsTable extends Migration
>>>>>>> 16b05e60849177353837a729893f03a10660946a
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD
        Schema::create(/**
         * @param Blueprint $table
         */
            'settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unique()->key();
            $table->string('chat_font');
            $table->string('chat_color');
            $table->boolean('enable_chat');
=======
        Schema::create('user_settings', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unique()->key();
<<<<<<< HEAD
            $table->string('chat_font')->default('comicSans');
            $table->string('chat_color')->default('blue');
            $table->boolean('enable_chat')->default(true);
>>>>>>> 16b05e60849177353837a729893f03a10660946a
=======
            $table->boolean('enable_chat')->default(1); //enabled by default
>>>>>>> 2c32be178e9c2a5b564c7b719b759a7a99bd7ede


            //$table->string('avatar');
        });
    }
<<<<<<< HEAD

=======
>>>>>>> 16b05e60849177353837a729893f03a10660946a
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
<<<<<<< HEAD
        Schema::drop('settings');
=======
        Schema::drop('user_settings');
>>>>>>> 16b05e60849177353837a729893f03a10660946a
    }
}
