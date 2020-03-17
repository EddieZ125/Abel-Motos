<?php

use App\Rol;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
		DB::table('users')->insert([
			'name' => 'administrador',
			'email' => 'admin@admin.com',
			'password' => Hash::make('admin'),
			'fecha_nacimiento' => '1970-01-01',
			'direccion' => 'TEST ADMIN',
			'rol_id' => Rol::where('rol', 'admin')->first()->id,
			'created_at' => $now,
			'updated_at' => $now,
		]);
		DB::table('users')->insert([
			'name' => 'vendedor',
			'email' => 'vendedor@vendedor.com',
			'password' => Hash::make('vendedor'),
			'fecha_nacimiento' => '1970-01-01',
			'direccion' => 'TEST VENDEDOR',
			'rol_id' => Rol::where('rol', 'vendedor')->first()->id,
			'created_at' => $now,
			'updated_at' => $now,
		]);
    }
}
