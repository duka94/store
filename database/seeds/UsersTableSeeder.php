<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        $faker = Faker::create();

        $data = [
          [
              'name' => $faker->name,
              'email' => 'employee@employee.com',
              'password' => bcrypt('secret'),
              'is_admin' => false,

          ],
          [
              'name' => $faker->name,
              'email' => 'employee1@employee.com',
              'password' => bcrypt('secret1'),
              'is_admin' => false,

          ],
          [
              'name' => $faker->name,
              'email' => 'employee2@employee.com',
              'password' => bcrypt('secret2'),
              'is_admin' => false,

          ],
          [
              'name' => $faker->name,
              'email' => 'employee3@employee.com',
              'password' => bcrypt('secret3'),
              'is_admin' => false,

          ],
          [
              'name' => $faker->name,
              'email' => 'admin@admin.com',
              'password' => bcrypt('adminSecret'),
              'is_admin' => true,
          ]
        ];

        User::insert($data);
    }
}
