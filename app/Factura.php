<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'facturas';
    protected $fillable = ['fecha', 'total', 'cliente_id'];
    protected $dates = ['created_at', 'updated_at'];

    protected function cliente() {
        return $this->belongsTo('App\Cliente');
    }

    protected function factura_producto() {
        return $this->hasOne('App\FacturaProducto', 'factura_id');
    }
}
