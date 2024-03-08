<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    protected $fillable= [
        'id',
        'estado'
    ];

    //relacion uno a muchos
    public function productos(){
        return $this->hasMany('App\Models\Producto');
    }


    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('estado', 'like', '%'.$query.'%'); 
    }
}
