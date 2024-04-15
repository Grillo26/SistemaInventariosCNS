<?php

namespace App\Models;
use App\Models\Producto;
use App\Models\Proveedor;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $fillable = ['producto_id','fecha','hora', 'cantidad','cantidad_entrada','cantidad_salida','proveedor_idProveedor','obs'];

    public function productos()
    {
        return $this->belongsTo(Producto::class, 'producto_id','id');
    }

    public function proveedors(){
        return $this->belongsTo(Proveedor::class, 'proveedor_idProveedor');
    }


}
