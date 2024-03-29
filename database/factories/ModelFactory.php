<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('secret'),
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Article::class, function(Faker $faker){       
    return[
        "title" => $faker->realText(50),
        "description" => $faker->realText(1000),
        "url" =>  $faker->imageUrl($width = 640, $height = 480),
    ];
 });

 $factory->define(App\Photo::class, function(Faker $faker){       
    return[
        "urlExtra" => $faker->imageUrl($width = 640, $height = 480)
    ];
 });