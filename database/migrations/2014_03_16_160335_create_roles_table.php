<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('rol');
            $table->timestamps();
        });

		$now = Carbon::now();
        DB::table('roles')->insert([
            'rol' => 'admin',
            'created_at' => $now,
			'updated_at' => $now,
        ]);
        DB::table('roles')->insert([
            'rol' => 'vendedor',
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
        Schema::dropIfExists('roles');
    }
}
