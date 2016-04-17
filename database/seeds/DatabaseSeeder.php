<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);                           //Seed the users table
        $this->call(ProjectsTableSeeder::class);                        //Seed the projects table
        //$this->call(ProjectCommentsTableSeeder::class);                 //Seed the project comments table
    }
}
