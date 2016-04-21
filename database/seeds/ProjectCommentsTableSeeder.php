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
        /*$dir = "public/images/seeds/";
        $images = glob($dir . "*");
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 1; $i++)
        {
            factory(ProjectComment::class, 'selfContained' ,1)->create();
            $newestID = DB::table('projects')->orderBy('created_at', 'desc')->first()->id;                  //Get the project that was just created's id
            $imagePath = 'public/images/projects/' . 'product' . $newestID . '.jpg';
            if (sizeof($images) <= $j)
                $j = 0;
            File::copy($images[$j], $imagePath);
        }*/
    }
}
