<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['codigo', 'nombre', 'precio', 'descripcion', 'cantidad', 'foto'];
    protected $dates = ['created_at', 'deleted_at'];
}
