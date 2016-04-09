<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PopulateProjectsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:PopulateProjectsTable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populates the projects table with some dummie projects for testing.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle() {
        $this->createEntry(
            'Squire Ultra',
            'Billy Bob',
            'Cross platform group IDE and super computer.',
            '2016-4-1 12'
        );
        $this->createEntry(
            'Fancy Images',
            'Bobby Bill',
            'Takes your photos and auto touches them up and allows for user edits.',
            '2016-4-2 6'
        );
        $this->createEntry(
            'News Catcher',
            'John Newsguy',
            'Collects all the news you need to know about based upon location and interests.',
            '2016-4-2 16'
        );
        $this->createEntry(
            'Key Remapper',
            'Gui Board',
            'Allows the user to remap any keys on their keyboard with ease.',
            '2016-4-4 10'
        );
        $this->createEntry(
            'Daily Activity Tracker',
            'Tom Renner',
            'Smart phone app that allows the user to keep track of their activity and is displayed in simple graphs.',
            '2016-4-4 15'
        );
        $this->createEntry(
            'Simple Graphs',
            'Tom Bergeron',
            'Takes the user\'s input and creates beautifully rendered graphs.',
            '2016-4-7 8'
        );
    }

    private function createEntry($title, $author, $description, $date) {
        $msg = sprintf(
            '+ [title=>\'%s\',author=>\'%s\', description=>\'%s\', date=>\'%s\']',
            $title, $author, $description, $date
        );
        $this->info($msg);

        DB::table('projects')->insert(
            array(
                'title' => $title,
                'author' => $author,
                'description' => $description,
                'created_at' => \Carbon\Carbon::createFromFormat('Y-m-d H', $date)
            )
        );
    }
}
