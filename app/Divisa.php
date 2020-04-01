<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divisa extends Model
{
    protected $table = 'divisas';
    protected $fillable = ['nombre', 'unidad'];
    protected $dates = ['created_at', 'updated_at'];

    protected function historial() {
        return $this->hasMany('App\HistorialDivisa');
    }

    protected function ultima_divisa() {
        return $this->hasOne('App\HistorialDivisa')->latest();
    }
}
