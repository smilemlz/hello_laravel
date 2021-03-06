<?php

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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    $date_time = $faker->date . ' ' . $faker->time;
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'is_admin' => false,
        'activated' => true,
        'password' =>$password?:$password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'create_time' => $date_time;
        'update_time' => $date_time;
    ];
});
