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
        $dir = "public/images/seeds/";
        $images = glob($dir . "*");

        $faker = Faker\Factory::create();
        //Creates projects
        for ($i = 0, $j = 0; $i < 10; $i++, $j++)
        {
            factory(Project::class, 1)->create();
            //factory(Project::class, 'selfContained', 1)->create();                                        //Use when wanting to create connected users with the project
            $newestID = DB::table('projects')->orderBy('created_at', 'desc')->first()->id;                  //Get the project that was just created's id

            $imagePath = 'public/images/projects/' . 'product' . $newestID . '.jpg';
            if (sizeof($images) <= $j)
                $j = 0;
            File::copy($images[$j], $imagePath);
        }
    }
}
