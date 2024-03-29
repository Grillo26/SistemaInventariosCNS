<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estante extends Model
{
    use HasFactory;

    protected $fillable= [
        'id',
        'n_estante',
        'descripcion'
    ];

     //relacion uno a muchos
     public function productos(){
        return $this->hasMany('App\Models\Producto');
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('id', 'like', '%'.$query.'%')
                ->orWhere('n_estante', 'like', '%'.$query.'%')
                ->orWhere('descripcion', 'like', '%'.$query.'%');
    }
}
