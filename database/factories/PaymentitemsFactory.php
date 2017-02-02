<?php

$factory->define(scool\enrollment_payments\Model\Paymentitem::class, function (Faker\Generator $faker) {
    return [
        'paymentitems_id' => $faker->unique()->randomDigitNotNull,
        'preu' => $faker->randomDigitNotNull,
        'unitats' => $faker->randomDigitNotNull,
    ];
});