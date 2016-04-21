<?php

use App\Project;
use Illuminate\Support\Facades\DB;

/**
 * Authors: Robert Breckenridge (original), Rick Boss (updater)
 */
class ProjectsTableMassSeeder extends MassSeeder
{
    private $images = '';

    /**
     * Initialize images path.
     */
    protected function setup()
    {
        $this->images = glob('public/images/seeds/*');
    }
    
    /**
     * Seeds with a randomly generated Project
     *
     * @param $iteration String: the current iteration
     * @return mixed
     */
    public function seed($iteration)
    {
        factory(Project::class, 1)->create([
            'author' => $this->faker->userName,
            'title' => $this->faker->realText(32),
            'description' => $this->faker->realText(30),
            'body' => $this->faker->realText()
        ]);

        $newestID = DB::table('projects')->orderBy('created_at', 'desc')->first()->id;                  //Get the project that was just created's id
        $imagePath = 'public/images/projects/' . 'product' . $newestID . '.jpg';

        File::copy($this->images[$iteration % 6], $imagePath);
    }
}
