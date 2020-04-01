<?php

use App\Divisa;
use App\HistorialDivisa;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fecha = Carbon::now();

        $divisa = Divisa::create([
            'nombre' => 'Bolivares',
            'unidad' => 'BS'
        ]);

        $ultima_divisa = HistorialDivisa::create([
            'divisa_id' => $divisa->id,
            'fecha' => $fecha,
            'tasa' => 81000
        ]);
    }
}
