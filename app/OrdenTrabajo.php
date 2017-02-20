<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OrdenTrabajo extends Model
{
    protected $table="orden_trabajos";
    protected $fillable=["idMAQ","nombre_maquinaria","marca_maquinaria","modelo_maquinaria","serie_maquinaria","kilometraje","horometro","fecha","localizacion_averia","tipo_mtto","descripcion_trabajo","duracion_tarea","cant_personal","cod_material","cantidad","observacion","estado"];
    protected $dates = ['deleted_at'];
}
