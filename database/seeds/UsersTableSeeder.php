<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create three App\User instances...
        $users = factory(App\User::class, 3)->make();
        
        // Create three App\User "admin" instances...
        // $users = factory(App\User::class, 'admin', 3)->make(); // TODO: add admin bool column to user table
    }
}
