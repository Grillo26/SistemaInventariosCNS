<?php

namespace App\Models;
use App\Models\Entrada;
use App\Models\Salida;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'n_comprobante',
        'detalle',
        'entrada_idEntrada',
        'salida_idSalida'
    ];

    public function entrada()
    {
        return $this->belongsTo(Entrada::class);
    }

    public function salida()
    {
        return $this->belongsTo(Salida::class);
    }
}
