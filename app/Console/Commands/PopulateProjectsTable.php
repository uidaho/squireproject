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
    protected $description = 'Populates the projects table with some dummy projects for testing.';

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
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempus lorem neque, at ultrices magna semper tincidunt. Integer in nisl consequat, porta dolor quis, hendrerit magna. In faucibus efficitur lacus, eu ullamcorper nisi suscipit vel. Morbi dui diam, rhoncus varius consectetur eu, finibus sit amet est. Donec ut viverra urna. Fusce auctor vestibulum elementum. Ut auctor ultrices mi, sed pulvinar enim porta et. Quisque tempor, risus quis pretium gravida, odio ipsum pulvinar ipsum, vel condimentum augue turpis eget purus. Donec volutpat risus diam, vel placerat risus finibus eget. Nam et lobortis mi.',
            '2016-4-1 12'
        );
        $this->createEntry(
            'Fancy Images',
            'Bobby Bill',
            'Takes your photos and auto touches them up and allows for user edits.',
            'Donec bibendum dapibus metus sit amet placerat. Aenean tempor dignissim augue vitae ornare. Nulla ultricies dolor a magna venenatis semper. Phasellus non nulla sit amet justo lacinia auctor. Sed purus elit, bibendum non molestie eu, varius et leo. Vivamus vitae nulla a leo ultrices mattis. Maecenas eu magna quis sapien pellentesque dapibus.',
            '2016-4-2 6'
        );
        $this->createEntry(
            'News Catcher',
            'John Newsguy',
            'Collects all the news you need to know about based upon location and interests.',
            'Duis vitae ipsum tortor. In at hendrerit odio. Duis pretium felis ipsum, id fringilla lorem lacinia eget. Curabitur faucibus porttitor purus, vitae ultrices orci malesuada et. Vivamus iaculis leo ac augue bibendum sagittis. Maecenas sollicitudin a lectus id vehicula.',
            '2016-4-2 16'
        );
        $this->createEntry(
            'Key Remapper',
            'Gui Board',
            'Allows the user to remap any keys on their keyboard with ease.',
            'Sed scelerisque lorem libero, eu vulputate ante posuere et. Maecenas nec faucibus nisi. Nulla facilisi. Suspendisse ornare rhoncus ex vitae tincidunt. Vivamus finibus libero at sagittis fringilla. Pellentesque augue ipsum, lobortis maximus pellentesque sit amet, lobortis sit amet sem.',
            '2016-4-4 10'
        );
        $this->createEntry(
            'Daily Activity Tracker',
            'Tom Renner',
            'Smart phone app that allows the user to keep track of their activity.',
            'Fusce tempus libero in sollicitudin vestibulum. Duis aliquet nisi lectus, quis interdum neque pretium sit amet. Sed non ipsum tempus, consequat dolor et, aliquam purus. Sed tincidunt, ante quis molestie elementum, elit lectus sodales velit, pellentesque scelerisque enim neque quis libero. Ut varius semper scelerisque.',
            '2016-4-4 15'
        );
        $this->createEntry(
            'Simple Graphs',
            'Tom Bergeron',
            'Takes the user\'s input and creates beautifully rendered graphs.',
            'Praesent consectetur iaculis enim sed dictum. Nam vulputate eget mi eu suscipit. Aenean interdum quis nisl sed tincidunt. Sed id risus sed magna imperdiet aliquet. Vivamus in urna vel nunc pretium molestie. Praesent mattis interdum enim, ut semper dui tincidunt id. Mauris ornare lorem ligula, et dignissim nisl aliquam nec. Quisque varius commodo mi. Duis vulputate nisi maximus sapien cursus molestie. Donec neque orci, viverra eget interdum sit amet, aliquet ut purus. Donec eleifend venenatis felis, sed semper odio congue vitae.',
            '2016-4-7 8'
        );
    }

    private function createEntry($title, $author, $description, $body, $date) {
        $msg = sprintf(
            '+[title=>\'%s\',author=>\'%s\', description=>\'%s\', date=>\'%s\']',
            $title, $author, $description, $date
        );
        $this->info($msg);

        DB::table('projects')->insert(
            array(
                'title' => $title,
                'author' => $author,
                'description' => $description,
                'body' => $body,
                'created_at' => \Carbon\Carbon::createFromFormat('Y-m-d H', $date)
            )
        );
    }
}
