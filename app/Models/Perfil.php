<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    //use HasFactory;
    protected $table = 'perfiles';
    protected $fillable = ['nombre'];
    public $timestamps = false;

    //Funcion para buscar clientes por el nombere
    public function scopeBuscador($query,$nombre){
        return $query->where('nombre','LIKE','%'.$nombre.'%');
    }
}