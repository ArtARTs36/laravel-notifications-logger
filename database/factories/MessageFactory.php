<?php

use ArtARTs36\LaravelNotificationsLogger\Models\Message;
use ArtARTs36\LaravelNotificationsLogger\Models\System;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        Message::FIELD_SYSTEM_ID => factory(System::class)->create()->id,
        Message::FIELD_BODY => $faker->randomHtml(),
        Message::FIELD_RECIPIENT => $faker->email,
        Message::FIELD_SENDER => $faker->email,
        Message::FIELD_SUBJECT => $faker->word,
    ];
});
