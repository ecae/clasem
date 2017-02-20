<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAltaMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alta_mantenimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mantenimiento_id')->unsigned();
            $table->foreign('mantenimiento_id')->references('id')->on('mantenimientos')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('proveedor_id')->unsigned();
            $table->foreign('proveedor_id')->references('id')->on('proveedors')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('ordentrabajo_id')->unsigned();
            $table->foreign('ordentrabajo_id')->references('id')->on('orden_trabajos')->onDelete('cascade')->onUpdate('cascade');
            $table->string('interno')->nullable();;
            $table->double('costo');
            $table->string('descripcion');
            $table->string('observacion')->nullable();
            $table->date('Nfecha_mantenimiento')->nullable();
            $table->integer('Nlimite_horometro')->nullable();
            $table->string('path')->nullable();
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
        Schema::dropIfExists('alta_mantenimientos');
    }
}
