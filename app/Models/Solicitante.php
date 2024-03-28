<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    use HasFactory;
    
    protected $fillable= [
        'id',
        'referencia',
        'detalle',
        'cantidad',
        'nombre_solicitante',
        'producto_idProducto',
        'estado_idEstado'
    ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('id', 'like', '%'.$query.'%')
            ->orWhere('referencia', 'like', '%'.$query.'%')
            ->orWhere('detalle', 'like', '%'.$query.'%')
            ->orWhere('cantidad', 'like', '%'.$query.'%')
            ->orWhere('nombre_solicitante', 'like', '%'.$query.'%')
            ->orWhere('producto_idProducto', 'like', '%'.$query.'%')
            ->orWhere('estado_idEstado', 'like', '%'.$query.'%');
            
    }
}
