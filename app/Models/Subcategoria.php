<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    use HasFactory;

    protected $fillable= [
        'id',
        'nombre_subcategoria',
        'categoria_idCategoria'
    ];

     //relacion uno a muchos
     public function productos(){
        return $this->hasMany('App\Models\Producto');
    }

     public function categorias(){
        return $this->hasMany('App\Models\Categoria');
    }
}
