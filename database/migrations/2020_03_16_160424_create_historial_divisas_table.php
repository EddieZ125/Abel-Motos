<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialDivisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_divisas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('divisa_id');
            $table->timestamp('fecha');
            $table->decimal('tasa',32,8);
            $table->timestamps();
            $table->foreign('divisa_id')->references('id')->on('divisas')
                  ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_divisas');
    }
}
