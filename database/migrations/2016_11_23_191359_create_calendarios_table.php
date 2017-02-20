<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mantenimiento_id')->unsigned();
            $table->foreign('mantenimiento_id')->references('id')->on('mantenimientos')->onDelete('cascade')->onUpdate('cascade');
            $table->string('titulo');
            $table->date('fecha_inicial');
            $table->date('fecha_final');
            $table->boolean('todoeldia');
            $table->string('color');
            $table->string('descripcion');
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
        Schema::drop('calendarios');
    }
}
