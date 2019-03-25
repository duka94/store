<?php

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->domainName,
        'code' => $faker->randomNumber(),
        'description' => $faker->text(),
        'price' => $faker->randomNumber(2),
        'img_path' => 'products/product1.jpg',
        'created_by' => factory(User::class)->create()->id,
        'category_id' => factory(Category::class)->create()->id,
    ];
});
