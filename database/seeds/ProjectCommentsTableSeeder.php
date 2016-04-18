<?php

use App\ProjectComment;
use Faker\Generator;
use Illuminate\Database\Seeder;

class ProjectCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creates just project comments
        factory(ProjectComment::class, 1)->create();

        //Creates project comments, users, and projects
        /*$faker = Faker\Factory::create();
        for ($i = 0; $i < 1; $i++)
        {
            factory(ProjectComment::class, 'selfContained' ,1)->create();
            $newestID = DB::table('projects')->orderBy('created_at', 'desc')->first()->id;                  //Get the project that was just created's id
            $imageURL = $faker->imageUrl(640, 480, 'technics');                                             //Get a new image
            $data = file_get_contents($imageURL);
            $new = base_path() . '/public/images/projects/' . 'product' . $newestID . '.jpg';
            file_put_contents($new, $data);
        }*/
    }
}
