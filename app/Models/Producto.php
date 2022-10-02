<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'codigo_producto',
        'nombre_producto',
        'unidad_idUnidad',
        'grupo_idGrupo',
        'cuenta_idCuenta'
    ];

    //relación muchos a uno
    public function unidads(){
        return $this->belongsTo('App\Models\Unidad');
    }
    public function cuentas(){
        return $this->belongsTo('App\Models\Cuenta');
    }
    public function estantes(){
        return $this->belongsTo('App\Models\Estante');
    }
    public function grupos(){
        return $this->belongsTo('App\Models\Grupos');
    }
    public function mesas(){
        return $this->belongsTo('App\Models\Mesa');
    }
    public function pasillos(){
        return $this->belongsTo('App\Models\Pasillos');
    }


}
