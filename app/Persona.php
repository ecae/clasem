<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Persona extends Model
{
    use SoftDeletes;
    protected $table = "personas";
    protected $fillable = ['nombre','apellidoPat','apellidoMat','area_id','user_id','email','estado'];
    protected $dates = ['deleted_at'];
}
