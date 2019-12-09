<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\StoreElement;
use Faker\Generator as Faker;

$factory->define(StoreElement::class, function (Faker $faker) {
    return [
        'store_id'=>\App\Store::all()->random()->id,
        'element_id'=>\App\Element::all()->random()->id
    ];
});
