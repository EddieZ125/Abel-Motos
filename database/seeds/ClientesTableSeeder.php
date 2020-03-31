<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,15) as $index) {
            DB::table('clientes')->insert([
                'nombre' => $faker->name,
                'cedula' => $faker->randomNumber(7),
                'direccion' => $faker->address,
                'telefono' => $faker->phoneNumber
            ]);
        }
    }
}
