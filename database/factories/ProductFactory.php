<?php

use App\Models\Product;
use App\Models\Category;
use Tests\Fakes\FileFake;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->domainName,
        'code' => 'dasda'.$faker->randomNumber(),
        'description' => $faker->text(),
        'price' => $faker->randomNumber(2),
        'img_path' => FileFake::file(),
        'category_id' => factory(Category::class)->create()->id,
    ];
});
