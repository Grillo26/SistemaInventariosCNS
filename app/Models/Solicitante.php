<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    use HasFactory;
    
    protected $fillable= [
        'id',
        'nombre_u',
        'codigo_u',
        'codigo_u2'
    ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('id', 'like', '%'.$query.'%')
            ->orWhere('nombre_u', 'like', '%'.$query.'%')
            ->orWhere('codigo_u', 'like', '%'.$query.'%')
            ->orWhere('codigo_u2', 'like', '%'.$query.'%');
    }
}
