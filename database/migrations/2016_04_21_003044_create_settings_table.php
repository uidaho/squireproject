<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_settings', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unique()->key();
            $table->string('chat_font')->default('comicSans');
            $table->string('chat_color')->default('blue');
            $table->boolean('enable_chat')->default(true);


            //$table->string('avatar');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_settings');
    }
}
