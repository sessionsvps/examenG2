<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            DB::table('videos')->insert([
                'nombre' => $faker->words(3, true),
                'stock' => 10,
                'precio' => $faker->randomFloat(2, 10, 100),
            ]);
        }
    }
}
