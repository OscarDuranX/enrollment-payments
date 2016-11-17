<?php


$factory->define(scool\enrollment_payments\payment::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});