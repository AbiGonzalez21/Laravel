<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoFactura extends Model
{
    //use HasFactory;
    protected $table = 'estadosfacturas';
    protected $fillable = ['nombre'];
    public $timestamps = false;
}
