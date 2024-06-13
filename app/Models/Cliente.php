<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //use HasFactory;
    protected $table = 'Clientes';
    //Aqui se deben de agregar todas las filas de la tabla para hacer la insercion
    protected $fillable = ['nombre', 'rfc', 'direccion','telefono', 'email'];
    public $timestamps = false;

    //Funcion para buscar clientes por el nombere
    public function scopeBuscador($query,$nombre){
    return $query->where('nombre','LIKE','%'.$nombre.'%');
}
}