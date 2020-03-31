<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'facturas';
    protected $fillable = ['fecha', 'cliente_id'];

    protected function cliente() {
        return $this->belongsTo('App\Client');
    }
}
