<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Device;
use Faker\Generator as Faker;

$factory->define(Device::class, function (Faker $faker) {
    return [
        'locale' =>  $faker->numberBetween(0, 1),
        'environment' =>  $faker->numberBetween(0, 1),
        "token" => $faker->asciify('11021*****'),
        'uuid' => $faker->uuid
    ];
});
