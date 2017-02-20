<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mantenimiento extends Model
{
    use SoftDeletes;
    protected $table="mantenimientos";
    protected $fillable=['fichatecnica_id','tipo_mantenimiento','detalle','fecha_inicial','dias','fecha_mantenimiento','limite_horometro','estado'];
    protected $dates = ['deleted_at'];
}
