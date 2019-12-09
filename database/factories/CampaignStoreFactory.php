<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CampaignStore;
use Faker\Generator as Faker;

$factory->define(CampaignStore::class, function (Faker $faker) {
    return [
        'store_id'=>\App\Store::all()->random()->id
    ];
});
