<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,20) as $index) {
            DB::table('productos')->insert([
                'codigo' => $faker->uuid,
                'nombre' => 'Producto ' . $faker->randomDigit,
                'precio' => $faker->randomNumber(2),
                'descripcion' => $faker->text,
                'cantidad' => $faker->randomDigit
            ]);
        }
    }
}
