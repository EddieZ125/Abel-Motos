<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $fillable = ['nombre', 'rif', 'telefono', 'email'];
    protected $dates = ['created_at', 'updated_at'];
}
