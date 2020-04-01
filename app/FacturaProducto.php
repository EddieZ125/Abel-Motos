<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturaProducto extends Model
{
    protected $table = 'factura_producto';
    protected $fillable = ['factura_id', 'producto_id', 'historial_divisa_id', 'cantidad', 'precio'];
    protected $dates = ['created_at', 'updated_at'];

    protected function producto() {
        return $this->hasOne('App\Producto', 'id', 'producto_id');
    }

    protected function factura() {
        return $this->hasOne('App\Factura', 'id', 'factura_id');
    }

    protected function ultima_divisa() {
        return $this->hasOne('App\HistorialDivisa', 'id', 'historial_divisa_id');
    }
}
