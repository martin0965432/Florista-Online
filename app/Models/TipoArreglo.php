<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoArreglo extends Model
{
    protected $fillable = ['nombre', 'precio', 'imagen'];

}
