<?php

use App\User;
use App\Project;
use App\ProjectComment;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

//Creates users
$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->regexify('(?=.*[a-zA-Z0-9])([A-Za-z0-9_ .]+)'),
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

// extend above to create 'admin' type user
$factory->defineAs(App\User::class, 'admin', function ($faker) use ($factory) {
    $user = $factory->raw(App\User::class);

    return array_merge($user, ['admin' => true]);
});

//Creates projects and uses previously made users
$factory->define(Project::class, function (Faker\Generator $faker) {
    $randUserNum = random_int(1, DB::table('users')->count());
    $username = DB::table('users')->lists('username')[$randUserNum];

    return [
        'title' => $faker->catchPhrase,
        'author' => $username,
        'description' => $faker->bs,
        'body' => $faker->paragraph,
    ];
});

//Creates projects and users
$factory->defineAs(Project::class, 'selfContained', function (Faker\Generator $faker) {

    return [
        'title' => $faker->catchPhrase,
        'author' => factory(User::class)->create()->username,
        'description' => $faker->bs,
        'body' => $faker->paragraph,
    ];
});
