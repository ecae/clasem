<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AsignarMaquinaria extends Model
{
    use SoftDeletes;
    protected $table="asignar_maquinarias";
    protected $fillable=['fichatecnica_id','persona_id','descripcion','estado'];
    protected $dates = ['deleted_at'];
}
