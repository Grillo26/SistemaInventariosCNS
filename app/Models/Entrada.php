<?php

namespace App\Models;
use App\Models\Proveedor;
use App\Models\Pasillo;
use App\Models\Estante;
use App\Models\Mesa;
use App\Models\Unidad;
use App\Models\Cuenta;
use App\Models\Grupo;
use App\Models\Producto;
use App\Models\Comprobante;
use App\Models\Inventario;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'producto_idProducto',
        'proveedor_idProveedor',
        'descripcion',
        'fecha_adquisicion',
        'fecha_caducidad',
        'cantidad',
        'valor_articulo',
        'n_lote'
    ];

    //relación muchos a uno
    public function productos(){
        return $this->belongsTo(Producto::class, 'producto_idProducto');
    }
    public function proveedors(){
        return $this->belongsTo(Proveedor::class, 'proveedor_idProveedor');
    }
    public function unidads(){
        return $this->belongsTo(Unidad::class, 'unidad_idUnidad');
    }
    public function cuentas(){
        return $this->belongsTo(Cuenta::class, 'cuenta_idCuenta');
    }
    public function grupos(){
        return $this->belongsTo(Grupo::class, 'grupo_idGrupo');
    }

    public function inventario()
    {
        return $this->belongsTo(Inventario::class);
    }

    public function comprobante()
    {
        return $this->hasOne(Comprobante::class, 'id');
    }
}
