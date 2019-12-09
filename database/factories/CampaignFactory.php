<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Campaign;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Campaign::class, function (Faker $faker) {
    $camp=$faker->sentence(2);
    $slug=Str::slug($camp);
    return [
        'campaign_name'=>$camp,
        'campaign_initdate'=>$faker->date(),
        'campaign_enddate'=>$faker->date(),
        'slug' =>$slug,
    ];
});
