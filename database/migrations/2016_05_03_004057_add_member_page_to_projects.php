<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddMemberPageToProjects
 *
 * Migration for adding the members page data to the project table.
 *
 * @author Robert Breckenridge
 */
class AddMemberPageToProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->index();
            $table->text('statement_title');
            $table->text('statement_body');
            $table->text('tab_title');
            $table->text('tab_body');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('statement_title');
            $table->dropColumn('statement_body');
            $table->dropColumn('tab_title');
            $table->dropColumn('tab_body');
        });
    }
}
