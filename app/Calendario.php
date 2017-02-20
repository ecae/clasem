<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Calendario extends Model
{
    use SoftDeletes;
    protected $table="calendarios";
    protected $fillable=['mantenimiento_id','titulo','fecha_inicial','fecha_final','todoeldia','color','estado'];
    protected $dates = ['deleted_at'];
}
