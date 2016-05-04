<?php

use Illuminate\Database\Seeder;
use App\ProjectRequest;

class ProjectRequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProjectRequest::class, 1)->create();
    }
}
