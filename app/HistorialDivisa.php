<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialDivisa extends Model
{
    protected $table = 'historial_divisas';
    protected $fillable = ['nombre', 'divisa_id', 'fecha', 'tasa'];
    protected $dates = ['created_at', 'updated_at'];

    protected function divisa() {
        return $this->belongsTo('App\Divisa');
    }
}
