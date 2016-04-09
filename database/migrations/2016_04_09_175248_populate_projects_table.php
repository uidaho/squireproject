<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $this->createEntry('Squire Ultra', 'Billy Bob', 'Cross platform group IDE and super computer.', '2016-4-1 12');
        $this->createEntry('Fancy Images', 'Bobby Bill', 'Takes your photos and auto touches them up and allows for user edits.', '2016-4-2 6');
        $this->createEntry('News Catcher', 'John Newsguy', 'Collects all the news you need to know about based upon location and interests.', '2016-4-2 16');
        $this->createEntry('Key Remapper', 'Gui Board', 'Allows the user to remap any keys on their keyboard with ease.', '2016-4-4 10');
        $this->createEntry('Daily Activity Tracker', 'Tom Renner', 'Smart phone app that allows the user to keep track of their activity and is displayed in simple graphs.', '2016-4-4 15');
        $this->createEntry('Simple Graphs', 'Tom Bergeron', 'Takes the user\'s input and creates beautifully rendered graphs.', '2016-4-7 8');
    }

    private function createEntry($title, $author, $description, $date) {
        DB::table('projects')->insert(
            array(
                'title' => $title,
                'author' => $author,
                'description' => $description,
                'created_at' => \Carbon\Carbon::createFromFormat('Y-m-d H', $date)
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

    }
}
