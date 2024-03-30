<?php

namespace App\Models;
use App\Models\User;


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
        'user_id',
        'producto_idProducto',
        'estado_idEstado'
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('id', 'like', '%'.$query.'%')
            ->orWhere('referencia', 'like', '%'.$query.'%')
            ->orWhere('detalle', 'like', '%'.$query.'%')
            ->orWhere('cantidad', 'like', '%'.$query.'%')
            ->orWhere('user_id', 'like', '%'.$query.'%')
            ->orWhere('producto_idProducto', 'like', '%'.$query.'%')
            ->orWhere('estado_idEstado', 'like', '%'.$query.'%');
            
    }
}
