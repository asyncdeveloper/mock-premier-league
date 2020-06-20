<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Fixture;
use App\Models\Team;
use Faker\Generator as Faker;

$factory->define(Fixture::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'match_date' => $faker->dateTimeBetween('now', '+5 years')->format('Y-m-d H:i:00'),
        'team1_id' => factory(Team::class),
        'team2_id' => factory(Team::class),
    ];
});
