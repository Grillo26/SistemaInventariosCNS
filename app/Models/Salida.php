<?php

namespace App\Models;
use App\Models\Pasillo;
use App\Models\Estante;
use App\Models\Mesa;
use App\Models\Producto;
use App\Models\Inventario;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'producto_idProducto',
        'fecha_salida',
        'stock_disponible',
        'cantidad_salida',
        'cantidad_stockTotal'
    ];

    //relación muchos a uno
    public function productos(){
        return $this->belongsTo(Producto::class, 'producto_idProducto');
    }
    
    public function pasillos(){
        return $this->belongsTo(Pasillo::class, 'pasillo_idPasillo');
    }
    public function estantes(){
        return $this->belongsTo(Estante::class, 'estante_idEstante');
    }
    public function mesas(){
        return $this->belongsTo(Mesa::class, 'mesa_idMesa');
    }
    
    public function inventario()
    {
        return $this->belongsTo(Inventario::class);
    }
}
