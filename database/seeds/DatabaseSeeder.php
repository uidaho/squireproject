<?php

use App\User;
use App\Project;
use App\ProjectComment;
use Illuminate\Database\Seeder;
use Faker\Generator;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);                         //Seed the users table
        $this->call(ProjectsTableSeeder::class);                      //Seed the projects table
    }
}
