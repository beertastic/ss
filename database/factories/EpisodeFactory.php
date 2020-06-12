<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Episode;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Config;

$factory->define(Episode::class, function (Faker $faker) {

    // added random thumbs from TVDB api in a config file to give the fake data more realism
    $episode_thumbs = Config::get('episode_thumbs');
    return [
        'uid' => $faker->slug(2),
        'name' => $faker->catchPhrase,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'thumbnail' => $episode_thumbs[array_rand($episode_thumbs, 1)],
        'duration' => rand(1200, 2700),
    ];
});
