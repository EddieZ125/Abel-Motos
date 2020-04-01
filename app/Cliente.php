<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $fillable = ['nombre', 'cedula', 'direccion', 'telefono'];
    protected $dates = ['created_at', 'updated_at'];
}
