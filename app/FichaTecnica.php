<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
class FichaTecnica extends Model
{
    use SoftDeletes;
    protected $table = "ficha_tecnicas";
    protected $fillable = ['fabricante','marca','modelo','descripcion','serie','fechacompra','path','estado'];
    protected $dates = ['deleted_at'];
    public function setPathAttribute($path){
        if(! empty($path)){
            $original = $path->getClientOriginalName();

            $this->attributes['path'] = $original;
            //$path->storeAs('fotos',$original);
            Storage::disk('imgMaquinaria')->put($original,file_get_contents($path->getRealPath()));

        }
    }
    /*
    public function setFechacompraAttribute($fechacompra){

        $format = str_replace('/', '-', $fechacompra);
        $Nfechacompra= date('Y-m-d', strtotime($format));
        $this->attributes['fechacompra'] = $Nfechacompra;
    }*/
}
