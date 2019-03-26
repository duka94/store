<?php

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Tests\Fakes\FileFake;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->domainName,
        'code' => 'dasda'.$faker->randomNumber(),
        'description' => $faker->text(),
        'price' => $faker->randomNumber(2),
        'img_path' => FileFake::file(),
        'created_by' => factory(User::class)->create()->id,
        'category_id' => factory(Category::class)->create()->id,
    ];
});
