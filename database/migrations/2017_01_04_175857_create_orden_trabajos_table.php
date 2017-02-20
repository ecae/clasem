<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_trabajos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idMAQ');
            $table->string('nombre_maquinaria');
            $table->string('marca_maquinaria');
            $table->string('modelo_maquinaria');
            $table->string('serie_maquinaria');
            $table->integer('kilometraje')->nullable();
            $table->integer('horometro')->nullable();
            $table->date('fecha')->nullable();
            $table->string('localizacion_averia');
            $table->string('tipo_mtto');
            $table->string('descripcion_trabajo');
            $table->string('duracion_tarea')->nullable();
            $table->string('cant_personal')->nullable();
            $table->string('cod_material')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('observacion')->nullable();
            $table->boolean('estado');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_trabajos');
    }
}
