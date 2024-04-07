<?php

namespace App\Models;
use App\Models\Producto;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $fillable = ['producto_id', 'cantidad','cantidad_entrada','cantidad_salida'];

    public function productos()
    {
        return $this->belongsTo(Producto::class);
    }
}
