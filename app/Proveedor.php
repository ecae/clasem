<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Proveedor extends Model
{
    use SoftDeletes;
    protected $table="proveedors";
    protected $fillable=["ruc","razonsocial","direccion","nombrecontacto","email","celular","descripcion","estado"];
    protected $dates = ['deleted_at'];
}
