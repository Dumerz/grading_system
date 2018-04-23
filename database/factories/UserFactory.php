<?php

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->userName,
        'name_first' => $faker->firstName($gender = 'male'|'female'),
        'name_middle' => $faker->lastName,
        'name_last' => $faker->lastName,
        'name_suffix' => $faker->optional()->suffix,
        'gender' => $faker->randomElement(["MALE", "FEMALE"]),
        'date_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'status' => $faker->randomElement(["USRSTAT001", "USRSTAT002", "USRSTAT003"]),
        'usertype' => $faker->randomElement(["USRTYPE001", "USRTYPE002", "USRTYPE003"]),
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
