<?php

use App\Models\Category;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->domainName,
        'created_by' => factory(User::class)->create()->id
    ];
});
