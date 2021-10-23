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

$factory->define(App\Users::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\id_ID\Address($faker));
    $faker->addProvider(new Faker\Provider\id_ID\Person($faker));
    return [
        'nama' => $faker->name,
        'username' => $faker->unique()->username,
        'password' => password_hash('1234', PASSWORD_BCRYPT),
        'alamat' => $faker->address
    ];
});
