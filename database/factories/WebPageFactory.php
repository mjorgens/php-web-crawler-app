<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\WebPage;
use Faker\Generator as Faker;

$factory->define(WebPage::class, function (Faker $faker) {
    return [
        'url' => $faker->url,
        'html' => "<a href='Test'>Test</a>"
    ];
});
