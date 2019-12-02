<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Notification;

$factory->define(Notification::class, function (Faker $faker) {
    return [
        'locale' =>  $faker->numberBetween(0, 1),
        'environment' =>  $faker->numberBetween(0, 1),
        'sound' =>  $faker->numberBetween(0, 1),
        'badge' =>  $faker->numberBetween(0, 100),
        "body" => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
        'title' => $faker->sentence($nbWords = 3, $variableNbWords = true)
    ];
});
