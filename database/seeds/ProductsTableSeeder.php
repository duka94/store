<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class ProductsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();

        $faker = Faker::create();



        $users = User::all();
        $categories = Category::all();

        $data = [
            [
                'name' => 'Product',
                'code' => rtrim($faker->randomNumber() . $faker->text(5), '.'),
                'created_by' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'created_at' =>  Carbon::now(),
                'description' => $faker->realText(270),
                'price' => $faker->randomNumber(2),
                'img_path' => 'products/product1.jpg',
            ],
            [
                'name' => 'Product 2',
                'code' => rtrim($faker->randomNumber() . $faker->text(5), '.'),
                'created_by' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'created_at' =>  Carbon::now(),
                'description' => $faker->realText(270),
                'price' => $faker->randomNumber(2),
                'img_path' => 'products/product2.jpg',
            ],
            [
                'name' => 'Product 3',
                'code' => rtrim($faker->randomNumber() . $faker->text(5), '.'),
                'created_by' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'created_at' =>  Carbon::now(),
                'description' => $faker->realText(270),
                'price' => $faker->randomNumber(2),
                'img_path' => 'products/product3.jpg',
            ],
            [
                'name' => 'Product 4',
                'code' => rtrim($faker->randomNumber() . $faker->text(5), '.'),
                'created_by' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'created_at' =>  Carbon::now(),
                'description' => $faker->realText(270),
                'price' => $faker->randomNumber(2),
                'img_path' => 'products/product4.jpg',
            ],
            [
                'name' => 'Product 5',
                'code' => rtrim($faker->randomNumber() . $faker->text(5), '.'),
                'created_by' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'created_at' =>  Carbon::now(),
                'description' => $faker->realText(270),
                'price' => $faker->randomNumber(2),
                'img_path' => 'products/product5.jpg',
            ]
        ];

        Product::insert($data);
    }
}
