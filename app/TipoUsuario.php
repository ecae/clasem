<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TipoUsuario extends Model
{
    use SoftDeletes;
    protected $table = "tipousuarios";
    protected $fillable = ['tipousuario'];
    protected $dates = ['deleted_at'];
}
