<?php

use App\Project;
use Faker\Generator;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        //Creates projects
        for ($i = 0; $i < 1; $i++)
        {
            factory(Project::class, 1)->create();
            //factory(Project::class, 'selfContained', 1)->create();                                        //Use when wanting to create connected users with the project
            $newestID = DB::table('projects')->orderBy('created_at', 'desc')->first()->id;                  //Get the project that was just created's id
            $imageURL = $faker->imageUrl(640, 480, 'technics');                                             //Get a new image
            $data = file_get_contents($imageURL);
            $new = base_path() . '/public/images/projects/' . 'product' . $newestID . '.jpg';
            file_put_contents($new, $data);
        }
    }
}
