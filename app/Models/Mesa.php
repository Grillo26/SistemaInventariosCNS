<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'n_mesa'
    ];

     //relacion uno a muchos
     public function productos(){
        return $this->hasMany('App\Models\Producto');
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('n_mesa', 'like', '%'.$query.'%'); 
    }
}
