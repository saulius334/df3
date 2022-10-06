<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Faker\Factory as F;

class DatabaseSeeder extends Seeder

{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        $faker = F::create('lt_LT');
        DB::table('users')->insert([
            'name' => 'Bebras',
            'email' => 'bebras@gmail.com',
            'password' => Hash::make('123'),
            'created_at' => $time,
            'updated_at' => $time,
            'role' => 1
        ]);
        DB::table('users')->insert([
            'name' => 'Briedis',
            'email' => 'briedis@gmail.com',
            'password' => Hash::make('123'),
            'created_at' => $time,
            'updated_at' => $time,
            'role' => 10
        ]);

        foreach([
            'Total Recall 2',
            'Tom and Tom 3',
            'Cobra and Robocop 5',
            'Shark and Cats',
            'Blue Gnom',
            'Lara and Tombs'
        ] as $movie) {
            DB::table('movies')->insert([
                'title' => $movie,
                'price' => rand(100, 1000) / 100,
                'created_at' => $time->addSeconds(1),
                'updated_at' => $time
            ]);
        }
        foreach(range(0,21) as $_) {
            DB::table('comments')->insert([
                'post' => $faker->paragraph(rand(0,9)),
                'movie_id' => rand(1, 6),
                'created_at' => $time->addSeconds(1),
                'updated_at' => $time
            ]);
        }
    }
}
