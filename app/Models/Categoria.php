<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable= [
        'id',
        'nombre_categoria'
    ];

     //relacion uno a muchos
     public function productos(){
        return $this->hasMany('App\Models\Producto');
    }

     public function subcategoria(){
        return $this->hasMany('App\Models\Subcategoria');
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('id', 'like', '%'.$query.'%')
                ->orWhere('n_estante', 'like', '%'.$query.'%')
                ->orWhere('descripcion', 'like', '%'.$query.'%');
    }
}
