<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baja extends Model
{
    use HasFactory;
    protected $fillable= [
        'id',
        'fecha_baja',
        'hora_baja',
        'cantidadb',
        'estadob'
    ];
}
