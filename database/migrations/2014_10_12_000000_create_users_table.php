<?php

use App\Rol;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->date('fecha_nacimiento');
			$table->longText('direccion');
			$table->unsignedBigInteger('rol_id');
			$table->rememberToken();
			$table->timestamps();

			$table->foreign('rol_id')->references('id')->on('roles');
		});

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

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}
}
