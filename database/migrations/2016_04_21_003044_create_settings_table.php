<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(/**
         * @param Blueprint $table
         */
            'settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unique()->key();
            $table->string('chat_font');
            $table->string('chat_color');
            $table->boolean('enable_chat');


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
        Schema::drop('settings');
    }
}
