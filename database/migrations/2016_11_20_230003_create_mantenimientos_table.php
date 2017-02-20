<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fichatecnica_id')->unsigned();
            $table->foreign('fichatecnica_id')->references('id')->on('ficha_tecnicas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('tipo_mantenimiento');
            $table->string('detalle');
            $table->date('fecha_inicial')->nullable();
            $table->integer('dias')->nullable();
            $table->date('fecha_mantenimiento')->nullable();
            $table->integer('limite_horometro')->nullable();
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
        Schema::drop('mantenimientos');
    }
}
