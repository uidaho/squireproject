<?php

use Illuminate\Database\Seeder;
use App\ProjectRequest;

/**
 * Class ProjectRequestTableSeeder
 *
 * Calls the factory to create project requests
 *
 * @author Robert Breckenridge (original)
 */
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
