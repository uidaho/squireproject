<?php

use App\ProjectComment;
use Faker\Generator;
use Illuminate\Database\Seeder;

class SC_CommentSeeder extends Seeder
{
    /**
     * Creates project comments, users, and projects all in one
     *
     * @return void
     */
    public function run()
    {
        $dir = "public/images/seeds/";
        $images = glob($dir . "*");

        $faker = Faker\Factory::create();
        for ($i = 0, $j = 0; $i < 10; $i++, $j++)
        {
            factory(ProjectComment::class, 'selfContained' ,1)->create();
            $newestID = DB::table('projects')->orderBy('created_at', 'desc')->first()->id;                  //Get the project that was just created's id
            $imagePath = 'public/images/projects/' . 'product' . $newestID . '.jpg';
            if (sizeof($images) <= $j)
                $j = 0;
            File::copy($images[$j], $imagePath);
        }
    }
}
