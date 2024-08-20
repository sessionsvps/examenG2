<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            DB::table('clientes')->insert([
                'nombres' => $faker->firstName,
                'apellidos' => $faker->lastName,
                'dni' => $faker->numerify('########'),
                'direccion' => $faker->address,
            ]);
        }
    }
}
