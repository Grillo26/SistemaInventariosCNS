<?php

namespace App\Models;
use App\Models\Unidad;
use App\Models\Cuenta;
use App\Models\Grupo;
use App\Models\Pasillo;
use App\Models\Estante;
use App\Models\Mesa;

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
        'cuenta_idCuenta',
        'pasillo_idPasillo',
        'estante_idEstante',
        'mesa_idMesa'
    ];

    //relación muchos a uno
    public function unidads(){
        return $this->belongsTo(Unidad::class, 'unidad_idUnidad');
    }
    public function cuentas(){
        return $this->belongsTo(Cuenta::class, 'cuenta_idCuenta');
    }
    public function grupos(){
        return $this->belongsTo(Grupo::class, 'grupo_idGrupo');
    }
    public function estantes(){
        return $this->belongsTo('App\Models\Estante');
    }
    public function mesas(){
        return $this->belongsTo('App\Models\Mesa');
    }
    public function pasillos(){
        return $this->belongsTo('App\Models\Pasillos');
    }
    //relacion uno a muchos
    public function entradas(){
        return $this->hasMany('App\Models\Entrada');
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('nombre_producto', 'like', '%'.$query.'%')
            ->orWhere('codigo_producto', 'like', '%'.$query.'%')
            
            ->orWhereHas('grupos', function($q) use ($query) { //Para Realizar busqueda usando las llaves foraneas
                $q->where('nombre_grupo', 'like', '%'.$query.'%');
            })
            ->orWhereHas('unidads', function($q) use ($query) { //Para Realizar busqueda usando las llaves foraneas
                $q->where('nombre_unidad', 'like', '%'.$query.'%');
            })
            ->orWhereHas('cuentas', function($q) use ($query) { //Para Realizar busqueda usando las llaves foraneas
                $q->where('nombre_cuenta', 'like', '%'.$query.'%');
            });
    }


}
