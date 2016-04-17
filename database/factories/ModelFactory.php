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
/*-----------------*
 *  Users Creator  *
 *-----------------*/
//Creates users
$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->unique()->regexify('^[a-zA-Z0-9-_]{6,16}'),
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

// extend above to create 'admin' type user
$factory->defineAs(User::class, 'admin', function ($faker) use ($factory) {
    $user = $factory->raw(User::class);

    return array_merge($user, ['admin' => true]);
});

/*--------------------*
 *  Projects Creator  *
 *--------------------*/
//Creates projects and uses previously made users
$factory->define(Project::class, function (Faker\Generator $faker) {
    $user = User::all()->random(1);

    return [
        'title' => $faker->unique()->regexify('[A-Za-z0-9_ .]{2,50}'),
        'author' => $user->username,
        //'user_id' => $user_id,
        'description' => $faker->regexify('[A-Za-z0-9_ .]{10,100}'),
        'body' => $faker->regexify('[A-Za-z0-9_ .]{100,65535}'),
    ];
});
//Creates projects and users
$factory->defineAs(Project::class, 'selfContained', function (Faker\Generator $faker) {
    return [
        'title' => $faker->unique()->regexify('[A-Za-z0-9_ .]{2,50}'),
        'author' => factory(User::class)->create()->username,
        //'user_id' => factory(User::class)->create()->id,
        'description' => $faker->regexify('[A-Za-z0-9_ .]{10,100}'),
        'body' => $faker->regexify('[A-Za-z0-9_ .]{100,65535}'),
    ];
});

/*----------------------------*
 *  Project Comments Creator  *
 *----------------------------*/
//Creates project comments and uses previously made users and projects
$factory->define(ProjectComment::class, function (Faker\Generator $faker) {
    $user = User::all()->random(1);
    $project = Project::all()->random(1);

    return [
        'user_id' => $user->id,
        'project_id' => $project->id,
        'comment_body' => $faker->regexify('(.*?)/s[6,256]'),
    ];
});

//Creates project comments, users, and projects
$factory->defineAs(ProjectComment::class, 'selfContained', function (Faker\Generator $faker) {

    return [
        'user_id' => factory(User::class)->create()->id,
        'project_id' => factory(Project::class)->create()->id,
        'comment_body' => $faker->regexify('(.*?)/s[6,256]'),
    ];
});