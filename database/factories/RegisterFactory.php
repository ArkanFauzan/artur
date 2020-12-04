<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Register;
use Faker\Generator as Faker;

$factory->define(Register::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'place'=>$faker->name,
        'wa'=>'081222',
        'email' => $faker->unique()->safeEmail,
        'ig'=>$faker->name
    ];
});
