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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});



$factory->define(\EONConsulting\Exports\Models\TaoResult::class, function (Faker\Generator $faker) {
    return [
        'lis_result_sourcedid' => EONConsulting\TaoClient\Services\UUID::make(),
        'delivery_execution_id' => '',
        'test_taker' => '',
        'score' => $faker->randomFloat(2,0, 1),
        'ingested' => '0',
        'status' => '2',
        'status_message' => 'API Response captured',
    ];
});
