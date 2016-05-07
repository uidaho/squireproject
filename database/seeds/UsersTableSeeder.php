<?php

use App\User;
use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder
 *
 * Seeder for creating users
 *
 * @author Robert Breckenridge (original)
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create();

        // Create three App\User "admin" instances...
        // $users = factory(App\User::class, 'admin', 3)->make(); // TODO: add admin bool column to user table
    }
}
