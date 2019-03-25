<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\User;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        $users = User::all();

        $data = [
            [
                'name' => 'Industry',
                'created_by' => $users->random()->id,
                'created_at' =>  Carbon::now(),
            ],
            [
                'name' => 'Functionality',
                'created_by' => $users->random()->id,
                'created_at' =>  Carbon::now(),
            ],
            [
                'name' => 'Performance',
                'created_by' => $users->random()->id,
                'created_at' =>  Carbon::now(),
            ]
        ];

        Category::insert($data);
    }
}
