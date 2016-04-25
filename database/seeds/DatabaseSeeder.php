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
        $this->call(ProjectsTableMassSeeder::class);                    //Use the mass seeder to seed the database.
        //$this->call(ProjectCommentsTableSeeder::class);                 //Seed the project comments table
        //$this->call(SC_CommentsSeeder::class);                          //Seed the project comments, users, and projects all in one
    }
}
