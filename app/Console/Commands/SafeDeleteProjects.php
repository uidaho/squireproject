<?php

namespace App\Console\Commands;

use App\Project;
use Illuminate\Console\Command;

/**
 * Class SafeDeleteProjects
 *
 * Command to delete some projects from the database. Allows
 * for mass deletion of projects including all related files
 * and entries in other tables.
 *
 * @author Rick Boss
 * @package App\Console\Commands
 */
class SafeDeleteProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'projects:Delete {num}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes projects from projects table along with their images.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $times = $this->argument('num');

        if ($times == 'all') {
            $this->deleteProjects(count(Project::all()));
        } else if (is_numeric($times) && $times > 0) {
            $this->deleteProjects($times);
        } else {
            $this->line('Unrecognized input: ' . $times);
        }
    }

    /**
     * Deletes a $num project(s).
     *
     * @param $num
     */
    private function deleteProjects($num)
    {
        $entries = Project::all();
        $toDelete = min($num, count($entries));

        for ($i = 0; $i < $toDelete; $i++) {
            $entries[$i]->delete();
        }
        $this->line('Deleted ' . $toDelete . ' projects.');
    }
}
