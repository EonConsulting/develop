<?php

use Faker\Generator as Faker;

$factory->define(\EONConsulting\Storyline2\Models\Course::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->text,
        'creator_id' => factory('App\Models\User')->create()->id,
        //'featured_image' => $faker->imageUrl(),
        // 'tags' => '',
        //'ingested' => '0',
        //'xml_file' => '',
    ];
});