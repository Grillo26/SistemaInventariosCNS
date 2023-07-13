<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'nombre_cuenta',
        'codigo_cuenta'
    ];

     //relacion uno a muchos
     public function productos(){
        return $this->hasMany('App\Models\Producto');
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('nombre_cuenta', 'like', '%'.$query.'%')
                ->orWhere('codigo_cuenta', 'like', '%'.$query.'%');
    }
}
