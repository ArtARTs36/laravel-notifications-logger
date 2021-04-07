<?php

use ArtARTs36\LaravelNotificationsLogger\Models\System;
use Faker\Generator as Faker;

$factory->define(System::class, function (Faker $faker) {
    return [
        System::FIELD_TITLE => $faker->word,
        System::FIELD_SLUG => $faker->slug,
    ];
});
