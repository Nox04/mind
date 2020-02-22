<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enums\MoodsEnum;
use App\Models\DiaryEntry;
use Faker\Generator as Faker;

$factory->define(DiaryEntry::class, function (Faker $faker) {
    return [
        'entry_date' => $faker->date(),
        'content' => $faker->text(500),
        'mood' => $faker->randomElement(MoodsEnum::getValues())
    ];
});
