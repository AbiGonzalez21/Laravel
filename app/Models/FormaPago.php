<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{
    //use HasFactory;
    protected $table = 'formaspago';
    protected $fillable = ['nombre'];
    public $timestamps = false;
}
