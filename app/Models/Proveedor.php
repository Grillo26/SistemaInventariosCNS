<?php

namespace App\Models;
use App\Models\Inventario;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    
    protected $fillable= [
        'id',
        'nombre_proveedor',
        'n_telefono',
        'email'
    ];

    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('id', 'like', '%'.$query.'%')
            ->orWhere('nombre_proveedor', 'like', '%'.$query.'%')
            ->orWhere('email', 'like', '%'.$query.'%');
    }
}
