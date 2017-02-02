<?php

$factory->define(scool\enrollment_payments\Model\Payment::class, function (Faker\Generator $faker) {
    return [
        'payable_id' => $faker->unique()->randomDigitNotNull,
        'payable_type' => $faker->name,
        'cantidad' => $faker->randomDigitNotNull,
    ];
});