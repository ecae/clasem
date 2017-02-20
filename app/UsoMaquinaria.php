<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UsoMaquinaria extends Model
{
    use SoftDeletes;
    protected $table = "uso_maquinarias";
    protected $fillable = ['fichatecnica_id','detalle','hora_Inicial','hora_Final','inicial_horometro','final_horometro','estado'];
    protected $dates = ['deleted_at'];
}
