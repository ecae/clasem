<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
class AltaMantenimiento extends Model
{
    use SoftDeletes;
    protected $table="alta_mantenimientos";
    protected $fillable=['mantenimiento_id','proveedor_id','interno','costo','descripcion','obsevacion','Nfecha_mantenimiento','Nlimite_horometro','path','estado'];
    protected $dates = ['deleted_at'];
    public function setPathAttribute($path){
        if(! empty($path)){
            $original = $path->getClientOriginalName();

            $this->attributes['path'] = $original;
            //$path->storeAs('fotos',$original);
            Storage::disk('fileOrdenTrabajo')->put($original,file_get_contents($path->getRealPath()));

        }
    }
}
